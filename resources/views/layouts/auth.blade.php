<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Purchasing System</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/purchasing.jpg') }}" rel="icon" type="image/jpg">

    <style>
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('https://konsultanku.co.id/assets/images/ef161e8cddde9939fff0ab930b0f2e38.jpeg');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
            text-align: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Darker overlay for better text readability */
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5); /* Optional: dark overlay */
            border-radius: 10px;
        }

        .hero-section h1 {
            font-size: 4em;
            margin-bottom: 0.5em;
        }

        .hero-section p {
            font-size: 1.5em;
            margin-bottom: 1em;
        }

        .hero-section .btn {
            font-size: 1.5em;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .hero-section .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="container">
            @yield('main-content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
