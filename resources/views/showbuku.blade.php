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
                    <div class="rating">
                        @php
                        $rating = 4.5; // Dapatkan nilai rating dari database, misalnya
                        $fullStars = (int) $rating;
                        $halfStar = $rating - $fullStars >= 0.5;
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
        <h2 class="text-lg lg:text-2xl font-bold text-black dark:text-black">Komentar</h2>
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
            <p>Anda hanya dapat memberikan ulasan sekali untuk buku ini.</p>
        @endif
    @else
        <p>Silakan login untuk memberikan ulasan.</p>
    @endif
    @foreach($ulasan->sortByDesc('created_at') as $ulasanBuku)
        @php
            $isCurrentUser = (Auth::check() && $ulasanBuku->user_id === Auth::user()->id);
        @endphp
        <article class="p-6 text-base bg-white dark:bg-white rounded-lg shadow mb-2 mt-10">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-base font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Michael Gough">{{$ulasanBuku->user->nama_lengkap}}</p>
                    <p class="text-sm text-base">{{$ulasanBuku->created_at->diffForHumans()}}</p>
                </div>
                @if($isCurrentUser)
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn m-1">=</div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a class="btn" onclick="my_modal_2.showModal()">Edit</a></li>
                            <li><a class="btn" onclick="my_modal_1.showModal()">Delete</a></li>
                        </ul>
                    </div>
                @endif
            </footer>
            <p class="text-base leading-4 mt-7">{{$ulasanBuku->Ulasan}}</p>
            <div class="flex items-center mt-4 space-x-4">

            </div>
        </article>
    @endforeach
</div>


{{-- End Komentar --}}
    </div>
</div>
{{-- end Produk --}}
{{-- modal Komentar --}}
<dialog id="my_modal_2" class="modal">
    <div class="modal-box">
        <form action="{{ route('review.update', ['id' => $ulasanBuku->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="Ulasan" class="block text-sm font-medium text-gray-700">Ulasan</label>
                <textarea name="Ulasan" id="Ulasan" rows="3" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                <!-- Ensure that the textarea contains the existing review content -->
            </div>
            <div class="flex items-center">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update Ulasan</button>
            </div>
        </form>
    </div>
</dialog>
  <dialog id="my_modal_1" class="modal">
    <div class="modal-box">
      <h3 class="font-bold text-lg">Hello!</h3>
      <p class="py-4">Press ESC key or click outside to close</p>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
{{-- end Modal Komentar --}}
@endsection
