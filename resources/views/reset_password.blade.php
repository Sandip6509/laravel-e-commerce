@extends('layouts')
@section('content')
    <div class="container-fluid">
        <div class="album py-5" style="height:60vh;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-success" style="margin-top: 4%;max-width: 35rem;padding: 2%;">
                    @include('flash_message')
                    <div>
                        <h2> Reset Password</h2>
                        <a href="{{ route('login') }}" class="float-end btn btn-outline-dark" style="margin-top: -9%;">Login</a>
                    </div>
                    <hr>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('reset_password_data') }}" method="POST" name="forgotPassForm" enctype="multipart/from-data">
                            @csrf
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <input type="password" class="form-control" name="password" id="password"
                                               required="required" placeholder="Enter Password">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm"
                                               required="required" placeholder="Enter Password Again">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <center>
                                <input type="submit" name="forgot_pass_btn" class="btn btn-outline-success"
                                       value="Reset Password">
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('locator')
@endsection
