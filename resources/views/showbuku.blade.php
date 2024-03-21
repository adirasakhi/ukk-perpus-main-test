@extends('layouts.app')

@section('content')

<section>
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
            }
            .rate:not(:checked) > input {
            position:absolute;
            display: none;
            }
            .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
            }
            .rated:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
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
            .star-rating-complete{
               color: #c59b08;
            }
            .rating-container .form-control:hover, .rating-container .form-control:focus{
            background: #fff;
            border: 1px solid #ced4da;
            }
            .rating-container textarea:focus, .rating-container input:focus {
            color: #000;
            }

            .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
            }
            .rated:not(:checked) > input {
            position:absolute;
            display: none;
            }
            .rated:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ffc700;
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
     </style>
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <!-- Di sini Anda bisa menampilkan gambar buku -->
                <img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/'.$buku->gambar) }}" alt="Buku {{ $buku->judul }}" />
            </div>
            <div class="col-md-6">
                <h4 class="lead fw-bolder">📚•{{ $buku->judul }}</h4>
                <h1 class="lead">📖 Kategori: {{ $buku->kategori->nama_kategori }}</h1>
                <h1 class="lead">📅 Year: {{ $buku->tahun_terbit }}</h1>
                <h1 class="lead">🏠 Penerbit: {{ $buku->penerbit }}</h1>
                <h1 class="lead">📜 Sinopsis: {{ $buku->sinopsis }}</h1>
                <h1 class="lead">✏️ Review: {{ $buku->ulasan_buku->count() }}</h1>
                <!-- Di sini Anda bisa menampilkan tombol atau form untuk menambahkan buku ke keranjang atau melakukan tindakan lainnya -->
                <form action="{{ route('pinjam.buku', ['id' => $buku->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Pinjam</button>
                </form>
                <div class="lead rate">
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
                </div>
            </div>
            <div class="container m-5 ">

                @foreach($ulasan as $ulasanBuku)
                <div class="row height d-flex justify-content-center align-items-center">
                        <div class="card shadow">
                            <div class="p-3">
                                <h6>Comments</h6>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center p-3 form-color"> <img src="{{asset('storage/profile_photos/'.$ulasanBuku->user->foto)}}" width="50" class="rounded-circle mr-2"> <input type="text" class="form-control" placeholder="Enter your comment..."> </div>
                            <div class="m-2">
                                <div class="d-flex flex-row p-3"> <img src="{{asset('storage/profile_photos/'.$ulasanBuku->user->foto)}}" width="40" height="40" class="rounded-circle mr-3">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row align-items-center">{{$ulasanBuku->user->nama_lengkap}}</div>
                                            <small>{{$ulasanBuku->created_at->diffForHumans()}}</small>
                                        </div>
                                        <p class="text-justify comment-text mb-0">{{$ulasanBuku->Ulasan}}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
</section>


</section>



@endsection
