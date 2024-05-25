<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Favicon -->
    <link href="{{ asset('img/purchasing.jpg') }}" rel="icon" type="image/jpg">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
        <div class="hero-content">
            <h1>Purchasing System</h1>
            <p>Manage your purchases efficiently and effectively with our system.</p>
            <p>Streamline your workflow, reduce costs, and improve productivity.</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
    </div>
</body>
</html>
