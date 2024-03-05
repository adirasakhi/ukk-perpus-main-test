@extends('layouts.app')

@section('content')
<style>
.product {
    transition: transform 0.3s ease-in-out;
}
.product:hover {
    transform: scale(1.05);

}
.buku-gambar {
    width: 300px;
    height: 200px;
    object-fit: cover;
    }

    /* Responsiveness */
    @media screen and (max-width: 375px) {
        .card-img-top {
            height: 10vw; /* Sesuaikan tinggi gambar dengan persentase lebar viewport untuk perangkat mobile dengan lebar layar minimal 375px */
        }
    }
</style>
    <div class="container mt-5">
        <h3 class="text-center">Koleksi Buku</h3>
        <div class="text-center w-50 mx-auto fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, libero dolore id perspiciatis laboriosam quibusdam perferendis explicabo fuga similique consectetur?</div>

        <!-- Form untuk pencarian -->
        <form action="{{ route('home') }}" method="GET" class="mt-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari buku atau penulis">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Form untuk filter kategori -->
        <form action="{{ route('home') }}" method="GET" class="mt-3">
            <div class="input-group">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->nama_kategori }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <!-- Menampilkan hasil pencarian -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 mt-5">
            @if(count($books) > 0)
                @foreach($books as $book)
                    <div class="col mb-5 product">
                        <div class="card shadow" >
                                <div class="card-body">
                                    <img class="img-thumbnail buku-gambar" src="{{asset ('storage/'.$book->gambar)}}" alt="..." />
                                <h3 class="card-text">{{ $book->judul }}</h3>
                                <h5 class="card-text fs-6 text-muted">{{ $book->tahun_terbit }}</h5>
                                <h5 class="card-text fs-6">{{ $book->penulis }}</h5>
                                <h5 class="card-text fs-6">{{ $book->penerbit }}</h5>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="#" class="btn btn-sm btn-primary d-block btnDetail" data-bs-toggle="modal" data-bs-target="#ModalBuku_{{ $book->id }}">Detail</a>
                                @php
                                    $averageRating = $book->ulasan_buku->avg('Rating');
                                @endphp
                                <span class="ms-auto text-warning fw-bold d-block text-center rate">★{{ number_format($averageRating, 1) }}/5</span>
                            </div>
                        </div>
                    </div>

<div class="modal fade" id="ModalBuku_{{ $book->id }}" tabindex="-1" aria-labelledby="ModalBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalBukuLabel">Form Peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-text">{{ $book->judul }}</h3>
                        <h5 class="card-text">{{ $book->penulis }}</h5>
                        <h5 class="card-text">{{ $book->penerbit }}</h5>
                        <h5 class="card-text">{{ $book->tahun_terbit }}</h5>
                        <p class="card-text">{{ $book->sinopsis}}</p>
                    </div>
                    <div class="col-md-4" >
                        <img src="{{asset ('storage/'.$book->gambar)}}" class="img-thumbnail w-100 mb-3" style="margin-left: 10px">
                        <p style="margin-left: 10px">rate:</p>
                        <span class="text-warning fw-bold d-block fs-5 rate mb-3" style="margin-left: 10px">★{{ number_format($averageRating, 1) }}/5</span>
                    </div>
                </div>
                <!-- Informasi User dan Komentar -->
                <div class="mt-3 border border-info rounded">
                    <h5 class="p-3 bg-info bg-opacity-10 border border-info rounded">Ulasan Pengguna</h5>
                    @if(count($book->ulasan_buku) > 0)
                        @foreach ($book->ulasan_buku as $index => $ulasan)
                            <div class="mb-3 border border-info p-2 rounded">
                                <div class="border-bottom border-primary ">
                                    <img src="{{ asset('images/buku1.jpg') }}" alt="User Avatar" class="rounded-circle" width="30">
                                    <span class="ms-2">{{ $ulasan->user->nama_lengkap }}  |</span>
                                    <span class="ms-2 text-warning fw-bold"> Rate: ★{{ $ulasan->Rating }}/5</span>
                                </div>
                                <span>Ulasan  :</span>
                                <span class="mb-2" style="font-size: 20px;">{{ $ulasan->Ulasan }}</span>
                            </div>
                            @if($index == 3 && count($book->ulasan_buku) > 4)
                                <div class="mb-3">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseUlasan_{{ $book->id }}" aria-expanded="false" aria-controls="collapseUlasan_{{ $book->id }}">
                                        Lihat lebih banyak ulasan
                                    </button>
                                </div>
                                <div class="collapse" id="collapseUlasan_{{ $book->id }}">
                            @endif
                        @endforeach
                        @if(count($book->ulasan_buku) > 4)
                                </div>
                        @endif
                    @else
                        <p>Tidak ada ulasan untuk buku ini.</p>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('pinjam.buku', ['id' => $book->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Pinjam</button>
                </form>
            </div>
        </div>
    </div>
</div>


                @endforeach
            @else
                <div class="text-center mx-auto">
                    <p class="fs-5 fw-bold mb-3">Buku atau Penulis "{{ request('search') }}" yang Anda cari tidak ada.</p>
                </div>
            @endif
        </div>

        <!-- last catalog -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary d-none btnModal" data-bs-toggle="modal" data-bs-target="#ModalBuku"></button>

        <script>
            document.querySelectorAll('.btnDetail').forEach(item => {
                item.addEventListener('click', (e) => {
                    // Dapatkan ID modal dari atribut data-bs-target
                    let modalId = e.currentTarget.getAttribute('data-bs-target');
                    let tombolModal = document.querySelector(modalId);
                    tombolModal.show();
                })
            });
        </script>
    </div>
@endsection
