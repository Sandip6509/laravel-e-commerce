@extends('admin.layouts')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lineitems</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Lineitems</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    @include('flash_message')
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Order id</th>
                                <th>user Name</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Order id</th>
                                <th>user Name</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @foreach ($orderItem->lineitemsData as $lineitemData) --}}
                                <tr>
                                    <td>LV - {{ $orderItem->order_id }}</td>
                                    <td>{{ $orderItem->customerData->fname }}</td>
                                    {{-- <td>{{ $orderItem->productData->name }}</td> --}}
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>{{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->total_price }}</td>
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
