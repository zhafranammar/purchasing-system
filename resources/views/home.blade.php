@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

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

    <div class="row">

        <!-- Earnings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($widget['earnings']) }}</div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$widget['orders']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-shopping fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order Item</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$widget['order_items']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-plus fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Customers') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Most Ordered Items</h6>
                </div>
                <div class="card-body">
                    @php
                        // Query untuk mengambil data item yang paling sering dibeli
                        $mostOrderedItems = DB::table('order_items')
                            ->select('item_id', DB::raw('count(*) as total'))
                            ->groupBy('item_id')
                            ->orderByDesc('total')
                            ->limit(5) // Limit untuk menampilkan 5 item teratas
                            ->get();
                        $totalOrders = App\Models\OrderItem::count();
                    @endphp

                    @foreach($mostOrderedItems as $item)
                        @php
                            // Query untuk mendapatkan detail produk
                            $product = App\Models\Item::find($item->item_id);
                        @endphp
                        @if($product)
                            <h4 class="small font-weight-bold">{{ $product->name }} <span class="float-right">{{ round(($item->total / $totalOrders) * 100, 2) }}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: {{ round(($item->total / $totalOrders) * 100) }}%" aria-valuenow="{{ round(($item->total / $totalOrders) * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>



        </div>

        <div class="col-lg-6 mb-4">

            <!-- Order -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Orders</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/svg/undraw_shopping_app_flsj.svg') }}" alt="Illustration of a shopping app">
                    </div>
                    <p>Explore and manage customer orders in detail.</p>
                    <a href="{{ route('orders.index') }}">View Orders →</a>
                </div>
            </div>

        </div>
    </div>
@endsection
