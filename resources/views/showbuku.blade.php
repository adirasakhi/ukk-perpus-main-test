@extends('layouts.main')

@section('content')
{{-- detail Produk --}}
<div class="md:flex items-center justify-center py-12 2xl:px-20 md:px-6 px-4 bg-base-100 shadow-xl p">
    <div class="xl:w-full bg-white shadow-xl rounded mx-auto"> <!-- Tambahkan mx-auto di sini -->
        <!-- Mengatur lebar menjadi 100% -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-10">
            <img class="w-full md:m-[6px]" alt="image of a girl posing" src="{{asset ('storage/'.$buku->gambar)}}" />
            <div class="p-6"> <!-- Menambahkan padding -->
                <!-- Menambahkan div dengan latar belakang putih dan padding -->
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
                <div class="flex justify-end mt-4"> <!-- Menambahkan class flex dan justify-end -->
                    <form action="{{ route('pinjam.buku', ['id' => $buku->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
{{-- Komentar --}}
<div class="px-4 m-10 shadow p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-black">Komentar</h2>
    </div>
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

    @php
        $userReviews = $ulasan->where('user_id', Auth::id())->sortByDesc('created_at');
        $otherReviews = $ulasan->whereNotIn('user_id', Auth::id())->sortByDesc('created_at');
    @endphp

    @if(!$userReviews->isEmpty())
        @foreach($userReviews as $ulasanBuku)
            <article class="p-6 text-base bg-white rounded-lg shadow mb-2 mt-10">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-base font-semibold">
                            @if($ulasanBuku->user->foto)
                            <img class="mr-2 w-6 h-6 rounded-full" src="{{asset('storage/profile_photos/' . $ulasanBuku->user->foto)}}" alt="Michael Gough">
                            @else
                                <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('images/undraw_profile_2.svg') }}" alt="Profile">
                            @endif
                            {{$ulasanBuku->user->nama_lengkap}}</p>
                        <p class="text-sm text-base">{{$ulasanBuku->created_at->diffForHumans()}}</p>
                    </div>
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

    @if(!$otherReviews->isEmpty())
        @foreach($otherReviews as $ulasanBuku)
            <article class="p-6 text-base bg-white rounded-lg shadow mb-2 mt-10">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-base font-semibold">
                            @if($ulasanBuku->user->foto)
                            <img class="mr-2 w-6 h-6 rounded-full" src="{{asset('storage/profile_photos/' . $ulasanBuku->user->foto)}}" alt="Michael Gough">
                            @else
                                <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('images/undraw_profile_2.svg') }}" alt="Profile">
                            @endif
                            {{$ulasanBuku->user->nama_lengkap}}</p>
                        <p class="text-sm text-base">{{$ulasanBuku->created_at->diffForHumans()}}</p>
                    </div>
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

    @if($ulasan->isEmpty())
        <p class="m-4">Buku ini belum memiliki komentar.</p>
    @endif
</div>



{{-- End Komentar --}}
    </div>
</div>
{{-- end Produk --}}
{{-- modal Komentar --}}

{{-- Modal Komentar --}}
@foreach($ulasan as $ulasanBuku)
    <dialog id="my_modal_{{ $ulasanBuku->id }}" class="modal">
        <div class="modal-box">
            <!-- Form untuk memperbarui ulasan -->
            <form action="{{ route('review.update', ['user_id' => $ulasanBuku->user_id, 'peminjaman_id' => $ulasanBuku->id]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="Ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                    <textarea name="Ulasan" id="Ulasan" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>{{ $ulasanBuku->Ulasan }}</textarea>
                    <!-- Pastikan textarea berisi ulasan yang ada -->
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
            <p class="py-4"></p>
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

{{-- end Modal Komentar --}}
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
@endsection

