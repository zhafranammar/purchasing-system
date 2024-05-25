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
                    <select class="form-control" id="customer_id" name="customer_id" required>
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
                    <textarea class="form-control summernote" id="address" name="address" rows="3" required>{{ $order->address }}</textarea>
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
                    <input type="text" class="form-control" id="discount" name="discount" value="{{ $order->discount }}" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" name="total" value="{{ $order->total }}" disabled>
        </div>
        @if ( Auth::user()->role == 'superadmin')
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Order</button>
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
                            <th>Action</th>
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
                            <td>
                                <form action="{{ route('order-items.delete', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
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

        <!-- Form to Add Order Item -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Order Item</h6>
            </div>
            <div class="card-body">
                <form action="/order-items" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select class="form-control" id="product_id" name="product_id" required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <input type="hidden" id="item_price" name="item_price">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" readonly>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button type="submit" class="btn btn-primary">Add Order Item</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('vendor/select2/js/select2.min.js')}}"></script>
    <script>
       $(document).ready(function() {
        if (typeof jQuery !== 'undefined') {
            console.log('jQuery is loaded');

            $.getScript("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js", function() {
                if (typeof $.fn.select2 !== 'undefined') {
                    console.log('Select2 is now loaded');
                    $('#product_id').select2();
                    $('#customer_id').select2();

                    $('#product_id').change(function() {
                        let selectedProduct = $(this).find('option:selected');
                        let price = selectedProduct.data('price');
                        let quantity = $('#quantity').val();

                        $('#quantity').val(1);
                        $('#price').val(price);
                        $('#item_price').val(price);
                    });

                    $('#quantity').on('input', function() {
                        let selectedProduct = $('#product_id').find('option:selected');
                        let price = selectedProduct.data('price');
                        let quantity = $(this).val();

                        let totalPrice = price * quantity;
                        $('#price').val(totalPrice);
                    });
                } else {
                    console.error('Select2 still not loaded after manual loading');
                }
            }).fail(function(jqxhr, settings, exception) {
                console.error('Failed to load Select2:', exception);
            });
        } else {
            console.error('jQuery is not loaded');
        }
    });

    </script>
@endsection
