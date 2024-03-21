@extends('layouts.app')

@section('content')
<style>
.card-product {
    transition: transform 0.3s ease-in-out;
    margin-top: -95px
}
.card-product:hover {
    transform: scale(1.05);

}
.search-bar {
    margin-bottom: 100px; /* Atur margin bottom pada search bar untuk memberikan ruang antara card dan search bar */
}
</style>
    <div class="container mt-5">
        <h3 class="text-center">Koleksi Buku</h3>
        <div class="text-center w-50 mx-auto fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, libero dolore id perspiciatis laboriosam quibusdam perferendis explicabo fuga similique consectetur?</div>

        <!-- Form untuk pencarian -->
        <form action="{{ route('home') }}" method="GET" class="">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari buku atau penulis">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <!-- Form untuk filter kategori -->
        <form action="{{ route('home') }}" method="GET" class="mt-2 search-bar">
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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                @if(count($books) > 0)
                @foreach($books as $book)
                    @php
                    $averageRating = $book->ulasan_buku->avg('Rating');
                    @endphp
                <div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item card-product">
                <div class="card shadow">
                    <div class="product">
                        <img src="{{asset ('storage/'.$book->gambar)}}" alt="">
                        <ul class="d-flex align-items-center justify-content-center list-unstyled icons">
                            <li class="icon"><span class="fas fa-expand-arrows-alt"></span></li>
                            <li class="icon mx-3"><span class="far fa-heart"></span></li>
                            <a href="#" class="text-danger"><li class="icon"><span class="fas fa-shopping-bag"></span></li></a>
                        </ul>
                            </div>
                            <div class="tag bg-red">New</div>
                            <div class="title pt-1 pb-1">{{ $book->judul }}</div>
                            <span class="text-warning text-center rate title">★{{ number_format($averageRating, 1) }}/5</span>
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
                    <div class="col-md-8 isi-buku text-center py-3">
                        <img src="{{asset ('storage/'.$book->gambar)}}" class="img-thumbnail buku-thumb">
                        <p style="margin-left: 10px">rate:</p>
                        <span class="text-warning fw-bold d-block fs-5 rate mb-3" style="margin-left: 10px">★{{ number_format($averageRating, 1) }}/5</span>

                        <h3 class="card-text">{{ $book->judul }}</h3>
                        <h5 class="card-text">{{ $book->penulis }}</h5>
                        <h5 class="card-text">{{ $book->penerbit }}</h5>
                        <h5 class="card-text">{{ $book->tahun_terbit }}</h5>
                        <p class="card-text">{{ $book->sinopsis }}</p>
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
                        <p style="margin-left: 20px">Tidak ada ulasan untuk buku ini.</p>
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
