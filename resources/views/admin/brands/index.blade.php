@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Brands</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Brands</li>
            </ol>
            @include('flash_message')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-list me-1"></i>
                    All Brands
                    <a href="{{ route('brands.create') }}" class="btn btn-outline-primary btn-sm float-end"><i
                            class="fa fa-list"></i> Add Brand</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td><img src="{{ url('brands') . '/' . $brand->image }}"
                                            alt="{{ $brand->name ?? 'Brand' }} Image" width="60"></td>
                                    <td style="max-width: 30px">
                                        <div style="display: flex;">
                                            <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}"
                                                class="text-warning"><i class="fa fa-edit me-2"
                                                    style="height:1.5em;"></i></a>
                                            <a href="{{ route('admin_brand_status', ['id' => $brand->id, 'status' => $brand->is_active == 1 ? 0 : 1]) }}"
                                                class="text-{{ $brand->is_active == 1 ? 'danger' : 'success' }}">
                                                @if ($brand->is_active == 1)
                                                    <i class="fa-solid fa-toggle-off me-2" style="height:1.8em"></i>
                                                @else
                                                    <i class="fa-solid fa-toggle-on me-2" style="height:1.8em"></i>
                                                @endif
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
