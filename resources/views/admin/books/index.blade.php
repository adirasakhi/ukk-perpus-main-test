@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Peminjam</h3>
                <p class="text-subtitle text-muted">Data Seluruh Peminjam</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    <!-- Minimal jQuery Datatable start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Table Buku
                </h5>
                <a href="{{ route('buku.create') }}" type="button">tambah Buku</a>
                <div class="dropdown items-end ms-auto">
                    <button class="btn btn-success dropdown-toggle me-1" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Exports
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"> <!-- Mengubah class dropdown-menu-end agar dropdown berada di kanan -->
                        <a class="dropdown-item" href="{{ route('export.excel') }}">Excel</a>
                        <a class="dropdown-item" href="{{ route('export.pdf') }}">Pdf</a>
                        <a class="dropdown-item" href="{{ route('export.csv') }}">Csv</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Cover</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Ulasan</th>
                                <th>Whislist</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td><img src="{{asset('storage/'.$book->gambar)}}" alt="Cover Buku"></td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->penerbit }}</td>
                                <td>{{ $book->tahun_terbit }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>
                                    @if($book->kategori)
                                    {{ $book->kategori->nama_kategori }}
                                    @else
                                    Buku Tidak Memiliki Kategori
                                    @endif
                                </td>
                                <td>{{ $book->ulasan_buku->count() }}</td>
                                <td>1</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <a href="{{ route('buku.edit', $book->id) }}"
                                                class="px-2 pt-2 btn btn-warning">
                                                <span class="select-all fa-fw fa-lg fas"></span>
                                            </a>
                                        </div>

                                            <div class="me-2">
                                                <form action="{{ route('buku.destroy', $book->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                                </form>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- Minimal jQuery Datatable end -->
@include('adminPage.include.footer')
@include('adminPage.include.script')
