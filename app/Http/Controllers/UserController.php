<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile(Request $request)
    {
        $user = auth()->user();
        $lineitems ='';
        $countries = Country::all();
        return view('profile',compact('user','countries','lineitems'));
    }

    public function userProfileUpdate(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|min:2|max:10|string',
            'lname' => 'required|min:2|max:10|string|different:fname',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        $user = User::find(auth()->user()->id);
        $user->update($requestData);
        return redirect()->route('user_profile')->with('success', 'User Profile Updated Successfully!');
    }

    public function userProfileImageUpdate(Request $request)
    {
        $this->validate($request, [
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        $imgName = 'profile_' . rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $user = User::find(auth()->user()->id);
        $existingProfile = $user->profile;
        $user->update($requestData);
        $profileExists = public_path("profiles/$existingProfile");
        if(file_exists($profileExists)) {
            unlink("profiles/$existingProfile");
        }
        return redirect()->route('user_profile')->with('success', 'User Profile Image Updated Successfully!');
    }
}
