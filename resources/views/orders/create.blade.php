@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Orders') }}</h1>

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
        <!-- Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Orders</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control summernote" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Orders</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        if (typeof jQuery !== 'undefined') {
            console.log('jQuery is loaded');

            $.getScript("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js", function() {
                if (typeof $.fn.select2 !== 'undefined') {
                    console.log('Select2 is now loaded');
                    $('#customer_id').select2();

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

