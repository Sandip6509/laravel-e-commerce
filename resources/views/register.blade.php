@extends('layouts')

@section('content')
    <div class="container mt-5">
        <div class="album py-5" >
            <div class="row h-100 justify-content-center align-items-center">
                <div class="card border-success" style="max-width: 65rem;padding: 2%;">
                    <div>
                        <h2> Registration</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <hr>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                        placeholder="First Name" required="">
                                </div>
                                <div class="col">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                        placeholder="Last Name" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" required="">
                                </div>
                                <div class="col">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contact" name="contact"
                                        placeholder="Contact" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="password" class="form-label">Password</label><br>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" required="">
                                </div>
                                <div class="col">
                                    <label for="gender" class="form-label">Gender</label><br>
                                    <input type="radio" id="gender" name="gender" value="Male"
                                        checked>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                    <input type="radio" id="gender" name="gender" value="Female">&nbsp;&nbsp;Female
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="Address" required=""></textarea>
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
                                <button type="submit" class="btn btn-outline-success">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('locator')
@endsection
