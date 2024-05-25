@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Customer') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Customer</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" disabled>
                </div>
                <div class="form-group">http://127.0.0.1:8000/items/index.html
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" disabled>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" disabled>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control summernote" id="address" name="address" rows="3" disabled>{{ $customer->address }}</textarea>
                </div>
                
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">Edit Customer</a>

            </div>
        </div>
    </div>
@endsection
