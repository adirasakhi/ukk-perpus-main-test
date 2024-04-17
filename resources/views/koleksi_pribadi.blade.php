@extends('layouts.main')

@section('content')
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
        .product {
    transition: transform 0.3s ease-in-out;
}

    </style>

<h3 class="text-center">Koleksi Pribadi</h3>
<div class="container ml-5 mt-10">
    <h1 class="text-2xl font-bold">Buku Yang sudah di pinjam</h1>
    <div class="flex m-10 ml-5">
        <div class="flex flex-wrap gap-4">
            @if($collection->isEmpty())
                <p class="text-center">Belum ada buku dalam koleksi pribadi.</p>
            @else
                @foreach($collection as $item)
                        <a href="#" onclick="detailBuku{{ $item->peminjaman->id }}.showModal()">
                            <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku gap-4"> <!-- Adjust card width -->
                                <figure><img src="{{ asset('storage/'.$item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                <div class="card-body">
                                    <h2 class="card-title">
                                        {{ $item->buku->judul }}

                                    </h2>

                                    <div class="lead rate">
                                        @php
                                            $ratingValue = $item->buku->ulasan_buku->avg('Rating'); // Dapatkan nilai rating dari database
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
                            </div>
                        </a>
                @endforeach
            @endif
        </div>
    <!-- Modal -->
    @foreach($collection as $item)

                <dialog id="detailBuku{{ $item->peminjaman->id }}" class="modal">
                    <div class="modal-box">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="card-text">{{ $item->buku->judul }}</h3>
                                        <h5 class="card-text">{{ $item->buku->penulis }}</h5>
                                        <h5 class="card-text">{{ $item->buku->penerbit }}</h5>
                                        <h5 class="card-text">{{ $item->buku->tahun_terbit }}</h5>
                                        <p class="card-text">{{ $item->buku->sinopsis}}</p>
                                    </div>
                                    <div class="col-md-4" >
                                        <img src="{{asset ('storage/'.$item->buku->gambar)}}" class="img-thumbnail w-100 mb-3" style="margin-left: 10px">
                                        <span class="ms-auto text-warning fw-bold d-block text-center rate"><span class="text-dark">Rate: </span>★{{ number_format($item->buku->ulasan_buku->avg('Rating'), 1) }}/5</span>
                                    </div>
                                </div>

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
                                        <div class="mt-3 text-right">
                                            <button type="submit" class="btn btn-success">Pengembalian</button>
                                        </div>
                                    </form>
                                @else
                                    <!-- Informasi peminjaman -->
                                    <p class="card-text"><strong>Tanggal Peminjaman:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPeminjaman)) }}</p>
                                    <p class="card-text"><strong>Tanggal Pengembalian:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPengembalian)) }}</p>
                                @endif
                            </div>
                            <form method="dialog" class="modal-backdrop">
                                <button>close</button>
                              </form>
                        </dialog>
@endforeach
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection
