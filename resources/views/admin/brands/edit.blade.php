@extends('admin.layouts')

@section('content')
    <main>
        <div class="container h-100">
            <h1 class="mt-4">Edit Brand</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Brands</li>
            </ol>
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
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">
                                <h5>Image Picture</h5>
                            </div>
                            <div class="card-body text-center">
                                <img class="img-account-image rounded-circle mb-2"
                                    src="{{ asset('brands') . '/' . $brand->image }}" alt="brand image" width="200">
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <form method="POST" action="{{ route('admin_brand_image', ['id' => $brand->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="file" class="form-control" id="image" name="image"
                                                placeholder="image">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="submit" name="update" id="update" value="Update image"
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
                                <h5>Brand Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('brands.update', ['brand' => $brand->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Meet" value="{{ $brand->name }}" required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="3" name="description" placeholder="description"
                                                required="">{{ $brand->description }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        <input type="submit" name="update" id="update" value="Update"
                                            class="btn btn-outline-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
