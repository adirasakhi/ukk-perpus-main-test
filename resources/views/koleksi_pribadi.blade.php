<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
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

    .rated:not(:checked) > label {
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

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }

    .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rated:not(:checked) > input {
        position: absolute;
        display: none;
    }

    .rated:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffc700;
    }

    .rated:not(:checked) > label:before {
        content: '★ ';
    }

    .rated > input:checked ~ label {
        color: #ffc700;
    }

    .rated:not(:checked) > label:hover,
    .rated:not(:checked) > label:hover ~ label {
        color: #deb217;
    }

    .rated > input:checked + label:hover,
    .rated > input:checked + label:hover ~ label,
    .rated > input:checked ~ label:hover,
    .rated > input:checked ~ label:hover ~ label,
    .rated > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
    .card-img-top {
        width: 100%;
        height: 10vw; /* Sesuaikan tinggi gambar dengan persentase lebar viewport */
        object-fit: cover;
    }

    /* Responsiveness */
    @media screen and (max-width: 375px) {
        .card-img-top {
            height: 10vw; /* Sesuaikan tinggi gambar dengan persentase lebar viewport untuk perangkat mobile dengan lebar layar minimal 375px */
        }
    }
</style>

@extends('layouts.app')

@section('content')
    <h3 class="text-center">Koleksi Pribadi</h3>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 mt-5">
        @forelse($collection as $item)
        <div class="col mb-5 product">
            <div class="card shadow" >
                <img class="card-img-top " src="{{asset ('storage/'.$item->buku->gambar)}}" alt="..." />
                    <div class="card-body">
                    <h3 class="card-text">{{ $item->buku->judul }}</h3>
                    <h5 class="card-text fs-6 text-muted">{{ $item->buku->tahun_terbit }}</h5>
                    <h5 class="card-text fs-6">{{ $item->buku->penulis }}</h5>
                    <h5 class="card-text fs-6">{{ $item->buku->penerbit }}</h5>
                </div>
                    <div class="card-footer d-flex justify-content-between">
                        @if ($item->peminjaman->StatusPeminjaman == 'Dipinjam')
                            <button type="button" class="btn btn-sm btn-primary btnDetail" data-bs-toggle="modal" data-bs-target="#ModalBuku_{{ $item->id }}">Detail</button>
                            <span class="ms-auto text-warning fw-bold d-block text-center rate">★{{ number_format($item->buku->ulasan_buku->avg('Rating'), 1) }}/5</span>
                            @else
                            <!-- Tampilkan informasi peminjaman -->
                            <p class="card-text"><strong>Tanggal Peminjaman:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPeminjaman)) }}</p>
                            <p class="card-text"><strong>Tanggal Pengembalian:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPengembalian)) }}</p>
                            <button type="button" class="btn btn-sm btn-primary btnDetail" data-bs-toggle="modal" data-bs-target="#ModalBuku_{{ $item->id }}">Detail</button>
                        @endif
                    </div>
                </div>
        </div>
    </div>

                <!-- Modal -->
                <div class="modal fade" id="ModalBuku_{{ $item->id }}" tabindex="-1" aria-labelledby="ModalBukuLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalBukuLabel">{{ $item->buku->judul }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Informasi buku -->
                                <img src="{{ asset('storage/'.$item->buku->gambar) }}" class="img-thumbnail">
                                <h3 class="card-text">{{ $item->buku->judul }}</h3>
                                <h5 class="card-text">{{ $item->buku->penulis }}</h5>
                                <h5 class="card-text">{{ $item->buku->penerbit }}</h5>
                                <h5 class="card-text">{{ $item->buku->tahun_terbit }}</h5>
                                <p class="card-text">{{ Str::limit($item->buku->sinopsis, 100) }}</p>

                                @if ($item->peminjaman->StatusPeminjaman == 'Dipinjam')
                                    <!-- Form for Ulasan dan Rating -->
                                    <form action="{{ route('pengembalian.buku', ['id' => $item->peminjaman->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $item->peminjaman->id }}">
                                        <div class="form-group">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                <label for="star5" title="5 stars">5 stars</label>
                                                <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                                <label for="star4" title="4 stars">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                <label for="star3" title="3 stars">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                <label for="star2" title="2 stars">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                <label for="star1" title="1 star">1 star</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200"></textarea>
                                        </div>
                                        <div class="mt-3 text-right">
                                            <button type="submit" class="btn btn-success">Pengembalian</button>
                                        </div>
                                    </form>
                                @else
                                    <!-- Informasi peminjaman -->
                                    <p class="card-text"><strong>Tanggal Peminjaman:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPeminjaman)) }}</p>
                                    <p class="card-text"><strong>Tanggal Pengembalian:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPengembalian)) }}</p>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada buku dalam koleksi pribadi.</p>
        @endforelse
    </div>
@endsection
