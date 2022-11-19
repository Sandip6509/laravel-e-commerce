<?php

namespace App\Http\Controllers;

use App\Events\WelcomeEmail;
use App\Mail\SendForgotPasswordEmail;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $countries = Country::all();
        return view('register', compact('countries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|min:2|max:10|string',
            'lname' => 'required|min:2|max:10|string|different:fname',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token']);
        $imgName = 'profile_' . rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $requestData['password'] = Hash::make($request->password);
        $requestData['role_id'] = User::USER_ROLE;
        $user = User::create($requestData);
        event(new WelcomeEmail($user));
        return redirect()->route('home', [], 301)->with('success', 'User Inserted Successfully.');
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $credencials = $request->only('email', 'password');
        if (Auth::attempt($credencials)) {
            if (auth()->user()->role_id == User::ADMIN_ROLE) {
                return redirect()->route('admin_home', [], 301);
            } else {
                return redirect()->route('home', [], 301);
            }
        }else{
            return redirect()->route('login', [], 301);
        }
    }

    public function forgotPassword(Request $request)
    {
        return view('forgot_password');
    }

    public function sendForgotPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);
        $requestData = $request->except('_token' , 'forgot_pass_btn');
        $requestData['token'] = Str::random('30');
        $forgotPasswordData = DB::table('password_resets')->insert($requestData);
        Mail::to($requestData['email'])->send(new SendForgotPasswordEmail($requestData));
        return view('forgot_password');
    }

    public function resetPassword(Request $request, $token)
    {
        $checkData = DB::table('password_resets')->where('email', $request->email)->where('token', $token)->count();
        if($checkData > 0){
            $email = $request->email;
            return view('reset_password', compact('email'));
        }else{
            return redirect()->route('forgot_password', [], 301)->with('danger', 'Invalid token.');
        }
    }

    public function resetPasswordData(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
        ]);
        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
        return redirect()->route('login', [], 301)->with('success', 'Password Reset Successfully.');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login', 301);
    }
}
