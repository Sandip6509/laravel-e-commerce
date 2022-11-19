@extends('layouts')
@section('content')
    <div class="container-fluid">
        <div class="album py-5" style="height:60vh;">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-success" style="margin-top: 4%;max-width: 35rem;padding: 2%;">
                    @include('flash_message')
                    <div>
                        <h2> Forgot Password</h2>
                    </div>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('send_forgot_password_email') }}" method="POST" name="forgotPassForm"
                            enctype="multipart/from-data">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" required="required"
                                    placeholder="Enter email">
                            </div>
                            <br>
                            <center>
                                <input type="submit" name="forgot_pass_btn" class="btn btn-outline-success"
                                    value="Send Email">
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('locator')
@endsection
