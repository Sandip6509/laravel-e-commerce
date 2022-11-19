@extends('admin.layouts')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa fa-truck me-1"></i>
                All Orders
            </div>
            <div class="card-body">
                @include('flash_message')
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>User Name</th>
                        <th>Sub Total</th>
                        <th>Tax Rate</th>
                        <th>Tax Amount</th>
                        <th>Shipping</th>
                        <th>Total Amount</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>User Name</th>
                        <th>Sub Total</th>
                        <th>Tax Rate</th>
                        <th>Tax Amount</th>
                        <th>Shipping</th>
                        <th>Total Amount</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>LV- {{ $order->id }}</td>
                            <td>{{ $order->customerData->full_name }}</td>
                            <td>{{ $order->sub_total }}</td>
                            <td>{{ $order->tax_rate }}</td>
                            <td>{{ $order->tax_amount }}</td>
                            <td>{{ $order->shipping }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->comment }}</td>
                            <td style="max-width: 30px">
                                <form method="post" action="{{ route('admin_order_status', ['id' => $order->id]) }}">
                                    @csrf
                                    <select class="form-select" id="status"
                                            aria-label="Default select example"
                                            required="" name="status">
                                        <option selected disabled>Select</option>
                                        @foreach(\Illuminate\Support\Facades\Config::get('order_status') as $status)
                                            <option value="{{ $status }}" @if($status == $order->status) {{ 'selected' }} @endif>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Update Status">
                                </form>
                                <a href="{{ route('admin_order_item', ['id' => $order->id]) }}"
                                   class="btn btn-sm btn-warning">View</a>
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
