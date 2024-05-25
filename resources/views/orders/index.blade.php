@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Orders') }}</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered" id="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->customer_id }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->subtotal }}</td>
                    <td>{{ $order->discount }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        @if ( Auth::user()->role == 'superadmin')
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @else
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#orders-table').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": []
            }]
        });
    </script>
@endsection

