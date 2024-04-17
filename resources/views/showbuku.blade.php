@extends('layouts.main')

@section('content')
<style>
    /* Style untuk rating */
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked) > input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked) > label:before {
        content: '★ ';
    }

    .rate > input:checked ~ label {
        color: #ffc700;
    }

    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }

    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }

    .star-rating-complete {
        color: #c59b08;
    }

    /* Style untuk form kontrol rating */
    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }

    /* Style untuk produk */
    .product {
        transition: transform 0.3s ease-in-out;
    }
</style>

<div class="md:flex items-center justify-center py-12 2xl:px-20 md:px-6 px-4 bg-base-100 shadow-xl p">
    <div class="xl:w-full bg-base-100 shadow-xl rounded mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-10">
            <img class="w-full md:m-[6px]" alt="image of a girl posing" src="{{asset('storage/'.$buku->gambar)}}" />
            <div class="p-6">
                <div>
                    <p class="text-base leading-4 mt-7">Judul Buku: {{ $buku->judul }}</p>
                    <p class="text-base leading-4 mt-4">Tahun Terbit: {{ $buku->tahun_terbit }}</p>
                    <p class="text-base leading-4 mt-4">Penerbit: {{ $buku->penerbit }}</p>
                    <p class="text-base leading-4 mt-4">Penulis: {{ $buku->penulis }}</p>
                    <p class="text-base leading-4 mt-4">Review: {{ $buku->ulasan_buku->count() }}</p>
                    <p class="text-base leading-4 mt-4">Whistlist: 5.1 inches</p>
                    <p class="text-base leading-4 mt-4">Kategori:</p>
                    <div class="badge badge-outline">{{ $buku->kategori->nama_kategori }}</div>
                    <p class="md:w-96 text-base leading-normal mt-4">Sinopsis: {{ $buku->sinopsis }}</p>
                    <div class="rating text-xl">
                        <!-- Perbaikan untuk menampilkan bintang sesuai rating -->
                        @php
                            $ratingValue = $buku->ulasan_buku->avg('Rating'); // Dapatkan nilai rating dari database
                            $fullStars = (int) $ratingValue;
                            $halfStar = $ratingValue - $fullStars >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $fullStars)
                                ⭐️ <!-- Bintang penuh -->
                            @elseif ($i == $fullStars + 1 && $halfStar)
                                🌟 <!-- Bintang setengah -->
                            @else
                                ☆ <!-- Bintang kosong -->
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <!-- Form untuk pengembalian atau peminjaman -->
                    @foreach ($buku->peminjaman as $item)
                        @if ($item->StatusPeminjaman == 'Dipinjam')
                            @if(Auth::check() && $item->user_id == Auth::user()->id)
                                <form action="{{ route('pengembalian.buku', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <div class="mt-3 text-right">
                                        <button type="submit" class="btn btn-success">Pengembalian</button>
                                    </div>
                                </form>
                            @endif
                        @else
                            <!-- Tampilkan tombol pengembalian hanya jika buku sedang dipinjam -->
                            @if(Auth::check())
                                <form action="{{ route('pinjam.buku', ['id' => $buku->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Pinjam</button>
                                </form>
                            @endif
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
        <!-- Bagian untuk komentar -->
        <div class="px-4 m-10 shadow p-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-black">Komentar</h2>
            </div>
            <!-- Form untuk menambahkan komentar -->
            @if(Auth::check())
                @php
                    $userReviewExists = $ulasan->where('user_id', Auth::id())->where('buku_id', $buku->id)->isNotEmpty();
                @endphp
                @if(!$userReviewExists)
                    <div class="mt-6">
                        <form action="{{ route('review', ['id' => $buku->id]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="Ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                                <textarea name="Ulasan" id="Ulasan" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="flex items-center">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Post Ulasan</button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="m-4">Anda hanya dapat memberikan ulasan sekali untuk buku ini.</p>
                @endif
            @else
                <p class="m-4">Silakan login untuk memberikan ulasan.</p>
            @endif

            <!-- Bagian untuk menampilkan komentar -->
            @if(!$ulasan->isEmpty())
                @foreach($ulasan as $ulasanBuku)
                    <article class="p-6 text-base bg-base-100 rounded-lg shadow mb-2 mt-10">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-base font-semibold">
                                    @if($ulasanBuku->user->foto != null)
                                        <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('storage/profile_photos/' . $ulasanBuku->user->foto) }}" alt="Profile">
                                    @else
                                        <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('images/undraw_profile_2.svg') }}" alt="Profile">
                                    @endif
                                    {{$ulasanBuku->user->nama_lengkap}}
                                </p>
                                <p class="text-sm text-base">{{$ulasanBuku->created_at->diffForHumans()}}</p>
                            </div>

                            <!-- Dropdown untuk opsi edit dan hapus -->
                            @if(Auth::check() && $ulasanBuku->user_id === Auth::user()->id)
                                <div class="dropdown">
                                    <div tabindex="0" role="button" class="btn m-1">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                        </svg>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box">
                                        <li><a class="btn" onclick="my_modal_{{ $ulasanBuku->id }}.showModal()">Edit</a></li>
                                        <li><a class="btn" onclick="my_modal_{{ $ulasanBuku->id }}_delete.showModal()">Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                        </footer>
                        <p class="text-base leading-4 mt-7">{{$ulasanBuku->Ulasan}}</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <!-- Konten tambahan jika diperlukan -->
                        </div>
                    </article>
                @endforeach
            @endif

            <!-- Pesan jika tidak ada komentar -->
            @if($ulasan->isEmpty())
                <p class="m-4">Buku ini belum memiliki komentar.</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal untuk komentar -->
@foreach($ulasan as $ulasanBuku)
    <dialog id="my_modal_{{ $ulasanBuku->id }}" class="modal">
        <div class="modal-box">
            <form action="{{ route('review.update', ['user_id' => $ulasanBuku->user_id, 'peminjaman_id' => $ulasanBuku->id]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="Ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                    <textarea name="Ulasan" id="Ulasan" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>{{ $ulasanBuku->Ulasan }}</textarea>
                </div>
                <div class="flex items-center">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update Ulasan</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
    <dialog id="my_modal_{{ $ulasanBuku->id }}_delete" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Hapus Komentar!</h3>
            <p class="py-4">Apakah Anda Yakin Ingin Menghapus Komentar ....?</p>
            <form action="{{ route('review.delete', ['id' => $ulasanBuku->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="bg-[red] rounded p-2">Hapus</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
@endforeach

<!-- Script untuk SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    window.onload = function() {
        @if(session('success'))
            showSuccessAlert('{{ session('success') }}');
        @endif

        @if(session('error'))
            showErrorAlert('{{ session('error') }}');
        @endif
    }

    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            showConfirmButton: false,
            timer: 1500
        });
    }

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
@endsection
