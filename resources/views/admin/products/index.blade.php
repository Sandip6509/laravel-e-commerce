@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
            @include('flash_message')
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-box-archive me-1"></i>
                    All Products
                    <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm float-end"><i
                            class="fa fa-box-archive me-1"></i> Add Product</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Color</th>
                                <th>Brand</th>
                                <th>Gender</th>
                                <th>Function</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ \Illuminate\Support\Str::title($product->name) }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ \Illuminate\Support\Str::title($product->color) }}</td>
                                    <td>{{ \Illuminate\Support\Str::title($product->getBrandData->name) }}</td>
                                    <td>{{ \Illuminate\Support\Str::title($product->gender) }}</td>
                                    <td>{{ \Illuminate\Support\Str::title($product->function) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td style="max-width: 30px">
                                        <div style="display: flex;">
                                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                class="text-warning"><i class="fa fa-edit me-2"
                                                    style="height:1.5em"></i></a>
                                            <a href="{{ route('admin_product_status', ['id' => $product->id, 'status' => $product->is_active == 1 ? 0 : 1]) }}"
                                                class="text-{{ $product->is_active == 1 ? 'danger' : 'success' }}">
                                                @if ($product->is_active == 1)
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
