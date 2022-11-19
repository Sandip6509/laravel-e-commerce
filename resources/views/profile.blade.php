@extends('layouts')

@section('content')
    <div class="container h-100 mt-5">
        <div class="container-xl px-4 mt-4">
            @include('flash_message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0 mt-4">
                        <div class="card-header">
                            <h5>Profile Picture</h5>
                        </div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2"
                                src="{{ asset('profiles') . '/' . $user->profile }}" width="100" height="100" alt="">
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <form method="POST" action="{{ route('user_profile_image_update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="file" class="form-control" id="profile" name="profile"
                                            placeholder="profile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="submit" name="update" id="update" value="Update Profile Image"
                                            class="btn btn-outline-primary">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Account Details</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user_profile_update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            placeholder="Meet" value="{{ $user->fname }}" required="">
                                    </div>
                                    <div class="col">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                            placeholder="Shah" value="{{ $user->lname }}" required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="name@example.com" required="" value="{{ $user->email }}">
                                    </div>
                                    <div class="col">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                            placeholder="1234567890" required="" value="{{ $user->contact }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="gender" class="form-label">Gender</label><br>
                                        <input type="radio" id="gender" name="gender" value="Male"
                                            @if ($user->gender == 'Male') {{ 'checked' }} @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                        <input type="radio" id="gender" name="gender" value="Female"
                                            @if ($user->gender == 'Female') {{ 'checked' }} @endif>&nbsp;&nbsp;Female
                                    </div>
                                    <div class="col">
                                        <label for="inputCountry" class="form-label">Country</label>
                                        <select class="form-select" id="inputCountry" aria-label="Default select example"
                                            required="" name="country">
                                            <option selected disabled>Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if ($user->country == $country->id) {{ 'selected' }} @endif>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="3" name="address" placeholder="address" required="">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <input type="submit" name="update" id="update" value="Update Profile"
                                        class="btn btn-outline-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">
                            <h5>My Orders</h5>
                        </div>
                        <div class="card-body text-center">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Shipping Charge</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lineitems as $lineitem)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $lineitem->productData->name }}</td>
                                            <td>{{ $lineitem->created_at }}</td>
                                            <td>₹ {{ $lineitem->price }}</td>
                                            <td>₹ {{ $lineitem->orderData->shipping }}</td>
                                            <td>{{ $lineitem->quantity }}</td>
                                            <td>₹ {{ $lineitem->total_price }}</td>
                                            <td>{{ $lineitem->orderData->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
