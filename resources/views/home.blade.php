@extends('layouts.main')

@section('content')

<div class="container md:mx-auto p-6">
    <div class="flex justify-end mt-10">
        <form action="{{ route('home') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Search books..." class="px-4 py-2 border rounded-md">
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
        </form>
    </div>

    <div class="flex justify-end mt-5">
        <form action="{{ route('home') }}" method="GET" class="flex items-center">
            <select name="kategori" class="px-4 py-2 border rounded-md">
                <option value="" selected>All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->nama_kategori }}">{{ $category->nama_kategori }}</option>
                @endforeach
            </select>
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
        </form>
    </div>


    {{-- container Buku Terbaru --}}
    <div class="container ml-5 mt-10">
        <h1 class="text-2xl font-bold">Buku Terbaru -------></h1>
        @if($books->isEmpty())
            <p class="mt-5">Buku tidak ada.</p>
        @else
            <div class="flex m-10 ml-5">
                <div class="flex flex-wrap gap-4">
                    @foreach($books as $book)
                        <a href="show/{{$book->slug}}">
                            <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku"> <!-- Adjust card width -->
                                <figure><img src="{{asset('storage/'.$book->gambar)}}" alt="{{ $book->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                <div class="card-body">
                                    <h2 class="card-title">
                                        {{ $book->judul }}
                                        @if(\Carbon\Carbon::parse($book->created_at)->diffInDays(\Carbon\Carbon::now()) <= 14)
                                            <div class="badge badge-secondary">NEW</div>
                                        @endif
                                    </h2>
                                    <div class="lead rate">
                                        @php
                                            $ratingValue = $book->ulasan_buku->avg('Rating'); // Dapatkan nilai rating dari database
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
                                    <div class="card-actions justify-end">
                                        <div class="badge badge-outline">{{ $book->kategori->nama_kategori }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- container Buku Dengan Rating Tertinggi --}}
    <div class="container ml-5 mt-20">
        <h1 class="text-2xl font-bold">Buku Dengan Rating Tertinggi -------></h1>
        @php
        $booksSortedByRating = $books->filter(function($book) {
            return $book->ulasan_buku->avg('Rating') >= 3;
        })->sortByDesc(function($book) {
            return $book->ulasan_buku->avg('Rating');
        });
    @endphp
        @if($booksSortedByRating->isEmpty())
            <p class="mt-5">Buku tidak ada.</p>
        @else
            <div class="flex m-10 ml-5">
                <div class="flex flex-wrap gap-4 ml-5">
                    @foreach($booksSortedByRating as $book)
                        <a href="show/{{$book->id}}">
                            <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku"> <!-- Adjust card width -->
                                <figure><img src="{{asset('storage/'.$book->gambar)}}" alt="{{ $book->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                <div class="card-body">
                                    <h2 class="card-title">
                                        {{ $book->judul }}
                                        @if(\Carbon\Carbon::parse($book->created_at)->diffInDays(\Carbon\Carbon::now()) <= 14)
                                            <div class="badge badge-secondary">NEW</div>
                                        @endif
                                    </h2>
                                    <div class="lead rate">
                                        @php
                                            $ratingValue = $book->ulasan_buku->avg('Rating'); // Dapatkan nilai rating dari database
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
                                    <div class="card-actions justify-end">
                                        <div class="badge badge-outline">{{ $book->kategori->nama_kategori }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- container Seluruh Buku --}}
    <div class="container ml-5 mt-20">
        <h1 class="text-2xl font-bold">Seluruh Buku -------></h1>
        @if($books->isEmpty())
            <p class="mt-5">Buku tidak ada.</p>
        @else
            <div class="flex m-10 ml-5">
                <div class="flex flex-wrap gap-4 ml-5">
                    @foreach($books as $book)
                        <a href="show/{{$book->id}}">
                            <div class="card w-full md:w-[250px] bg-base-100 shadow-xl card-buku"> <!-- Adjust card width -->
                                <figure><img src="{{asset('storage/'.$book->gambar)}}" alt="{{ $book->judul }}" class="h-[300px] md:h-auto" /></figure> <!-- Adjust image height -->
                                <div class="card-body">
                                    <h2 class="card-title">
                                        {{ $book->judul }}
                                        @if(\Carbon\Carbon::parse($book->created_at)->diffInDays(\Carbon\Carbon::now()) <= 14)
                                            <div class="badge badge-secondary">NEW</div>
                                        @endif
                                    </h2>
                                    <div class="lead rate">
                                        @php
                                            $ratingValue = $book->ulasan_buku->avg('Rating'); // Dapatkan nilai rating dari database
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
                                    <div class="card-actions justify-end">
                                        <div class="badge badge-outline">{{ $book->kategori->nama_kategori }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
