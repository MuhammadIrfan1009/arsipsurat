<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to eKomdigi</h1>
        
        @if (Auth::check())
            <p>Hello, {{ Auth::user()->nama }}!</p>
            <p>Your role is: {{ Auth::user()->role }}</p>

            <h2>Your Dashboard</h2>
            <ul>
                <li><a href="{{ route('suratMasuk.index') }}">Surat Masuk</a></li>
                <li><a href="{{ route('suratKeluar.index') }}">Surat Keluar</a></li>
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            </ul>
        @else
            <p>Please <a href="{{ route('auth.login') }}">login</a> to access your dashboard.</p>
        @endif
    </div>
</body>
</html>
