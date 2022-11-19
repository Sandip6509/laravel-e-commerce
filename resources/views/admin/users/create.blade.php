@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin_user_list') }}">User List</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-user me-1"></i>
                    Register User
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin_user_profile_register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="Meet"
                                    required="">
                            </div>
                            <div class="col">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Shah"
                                    required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="name@example.com" required="">
                            </div>
                            <div class="col">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contact" name="contact"
                                    placeholder="1234567890" required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="password" class="form-label">Password</label><br>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password" required="">
                            </div>
                            <div class="col">
                                <label for="gender" class="form-label">Gender</label><br>
                                <input type="radio" id="gender" name="gender" value="Male"
                                    checked>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                <input type="radio" id="gender" name="gender" value="Female">&nbsp;&nbsp;Female
                            </div>
                            <div class="col">
                                <label for="gender" class="form-label">Role</label><br>
                                <input type="radio" id="role_id" name="role_id" value="1"
                                    checked>&nbsp;&nbsp;Admin&nbsp;&nbsp;
                                <input type="radio" id="role_id" name="role_id" value="0">&nbsp;&nbsp;User
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" name="address" placeholder="address" required=""></textarea>
                            </div>
                            <div class="col">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" aria-label="Default select example"
                                    required="" name="country">
                                    <option selected disabled>Select</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="profile" class="form-label">Profile</label><br>
                                <input type="file" class="form-control-file" name="profile" id="profile">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="regist" id="regist" value="Register"
                                class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
