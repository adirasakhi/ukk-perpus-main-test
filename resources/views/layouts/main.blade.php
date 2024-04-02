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
{{-- alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Panggil fungsi untuk menampilkan SweetAlert saat halaman dimuat
    window.onload = function() {
        // Periksa apakah ada pesan success dari controller
        @if(session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        // Periksa apakah ada pesan error dari controller
        @if(session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif
    }

    // Fungsi untuk menampilkan SweetAlert dengan pesan success
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            showConfirmButton: false,
            timer: 1500
        });
    }

    // Fungsi untuk menampilkan SweetAlert dengan pesan error
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            showConfirmButton: false,
            timer: 1500
        });
    }
</script>

</body>

</html>
