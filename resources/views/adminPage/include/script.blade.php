<script src="{{ asset('mazer/assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('mazer/assets/compiled/js/app.js') }}"></script>
<!-- Need: Apexcharts -->
<script src="{{ asset('mazer/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('mazer/assets/static/js/pages/dashboard.js') }}"></script>
{{-- Jquery dataTable --}}
<script src="{{ asset('mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('mazer/assets/static/js/pages/datatables.js') }}"></script>
{{-- Img Uploader --}}
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond/filepond.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('mazer/assets/static/js/pages/filepond.js') }}"></script>
{{-- date Picker --}}
<script src="assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="assets/static/js/pages/date-picker.js"></script>
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
