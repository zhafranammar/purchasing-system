@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Order') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-4">
        <!-- Form to Edit Order -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Order</h6>
                </div>
            </div>
            <div class="card-body">
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $order->code }}" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <select class="form-control" id="customer_id" name="customer_id" disabled>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control summernote" id="address" name="address" rows="3" disabled>{{ $order->address }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control" id="date" name="date" value="{{ $order->date }}" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subtotal">Subtotal</label>
                    <input type="text" class="form-control" id="subtotal" name="subtotal" value="{{ $order->subtotal }}" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount" value="{{ $order->discount }}" disabled>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" name="total" value="{{ $order->total }}" disabled>
        </div>                          
        @if ( Auth::user()->role == 'superadmin')
            <div class="form-group">
                <a href="{{route('orders.edit', $order->id)}}" class="btn btn-primary">Edit Order</a>
            </div>
        @endif
    </form>
</div>

        </div>

        <!-- Table to Display Order Items -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Items</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_items as $item)
                        <tr>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->price/ $item->qty  }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>{{ $item->price - $item->discount }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ $order->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>{{ $order->discount }}</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>{{ $order->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
