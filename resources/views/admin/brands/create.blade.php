@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Brands</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands List</a></li>
                <li class="breadcrumb-item active">Brands</li>
            </ol>
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
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-list me-1"></i>
                    Add Brand
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Titan"
                                    required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description" placeholder="description"
                                    required=""></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="image" class="form-label">Image</label><br>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <input type="submit" name="add" id="add" value="Add"
                                class="btn btn-outline-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
