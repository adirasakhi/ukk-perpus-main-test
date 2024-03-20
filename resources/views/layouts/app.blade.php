<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>perpus-e</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Font Awesome 5 CSS -->
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css'>
        <!-- Products List CSS -->
        <link rel="stylesheet" href="{{ asset ('css/style.css') }}">
    <style>
        .profile-btn {
            width: 50px;
            height: 50px;
            background-image: url('{{ asset('images/buku1.jpg') }}'); /* Ganti path/to/your/circular-image.jpg sesuai dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 50%;
            border: none;
        }
        .card-img-top {
            width: 100%;
            height: 25vw;
            object-fit: cover;
        }    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')
    <!-- End Navbar -->

    <!-- Content -->
    <div class="container mt-5">
        @yield('content')
    </div>
    <!-- End Content -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
