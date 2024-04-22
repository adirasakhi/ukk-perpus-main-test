@extends('layouts.main')

@section('content')
    <style>
        .rate,
        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked) > input,
        .rated:not(:checked) > input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked) > label,
        .rated:not(:checked) > label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked) > label {
            color: #ffc700;
        }

        .rate > input:checked ~ label,
        .rated > input:checked ~ label {
            color: #ffc700;
        }

        .rate:not(:checked) > label:before,
        .rated:not(:checked) > label:before {
            content: '★ ';
        }

        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label,
        .rated:not(:checked) > label:hover,
        .rated:not(:checked) > label:hover ~ label {
            color: #deb217;
        }

        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label,
        .rated > input:checked + label:hover,
        .rated > input:checked + label:hover ~ label,
        .rated > input:checked ~ label:hover,
        .rated > input:checked ~ label:hover ~ label,
        .rated > label:hover ~ input:checked ~ label {
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

        .product {
            transition: transform 0.3s ease-in-out;
        }
    </style>

    <h3 class="text-center">Koleksi Pribadi</h3>
    <div class="container ml-5 mt-10">
        <h1 class="text-2xl font-bold">Buku Yang Sedang Di Pinjam</h1>
        <div class="flex m-10 ml-5">
            <div class="flex flex-wrap gap-4">
                @if($collection->isEmpty())
                    <p class="text-center">Belum ada buku dalam koleksi pribadi.</p>
                @else
                    @foreach($collection as $item)
                        @if ($item->peminjaman->StatusPeminjaman == 'Dipinjam')
                            <a href="/show/{{ $item->buku->slug }}" onclick="detailBuku{{ $item->peminjaman->id }}.showModal()">
                                <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku gap-4"> <!-- Adjust card width -->
                                    <figure><img src="{{ asset('storage/'.$item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $item->buku->judul }}</h2>
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
                                        <!-- Informasi peminjaman -->
                                        <p class="card-text"><strong>Tanggal Peminjaman:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPeminjaman)) }}</p>
                                        <p class="card-text"><strong>Tanggal Pengembalian:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPengembalian)) }}</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="container ml-5 mt-10">
        <h1 class="text-2xl font-bold">Buku Yang Sudah Di Kembalikan</h1>
        <div class="flex m-10 ml-5">
            <div class="flex flex-wrap gap-4">
                @if($collection->isEmpty())
                    <p class="text-center">Belum ada buku dalam koleksi pribadi.</p>
                @else
                    @foreach($collection as $item)
                        @if ($item->peminjaman->StatusPeminjaman == 'Dikembalikan')
                            <a href="/show/{{ $item->buku->slug }}" onclick="detailBuku{{ $item->peminjaman->id }}.showModal()">
                                <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku gap-4"> <!-- Adjust card width -->
                                    <figure><img src="{{ asset('storage/'.$item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $item->buku->judul }}</h2>
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
                                        <!-- Informasi peminjaman -->
                                        <p class="card-text"><strong>Tanggal Peminjaman:</strong> {{ date('d-m-Y', strtotime($item->peminjaman->TanggalPeminjaman)) }}</p>
                                        @php
                                        $tanggalPengembalian = \Carbon\Carbon::parse($item->peminjaman->TanggalPengembalian);
                                    @endphp

                                    <span class="{{ $tanggalPengembalian->diffInDays() > 14 ? 'text-red-500' : '' }}">
                                        {{ $tanggalPengembalian->format('d-m-Y') }}
                                    </span>

                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
