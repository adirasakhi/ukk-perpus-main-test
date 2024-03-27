<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <style>
    .card-buku:hover {
    transform: scale(1.1); /* Membuat kartu 10% lebih besar saat dihover */
    transition: transform 0.3s ease; /* Efek transisi untuk membuat perubahan lebih halus */
}
  </style>
</head>
<body>


{{-- Navbar --}}
@include('layouts.navbar')
{{-- end Navbar --}}
{{-- Content --}}
<div class="container mt-5 justify-center items-center mx-auto overflow-hidden">
    @yield('content')
</div>
{{-- end Content --}}


</body>

</html>
