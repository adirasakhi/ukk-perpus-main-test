@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Buku</h3>
                <p class="text-subtitle text-muted">Mengubah Buku</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/buku">Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Mengubah Buku</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form action="{{ route('buku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Judul-Buku">Judul Buku</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="Judul-Buku" class="form-control" name="judul"
                                placeholder="Judul Buku" id="judul" value="{{ $book->judul }}">
                        </div>
                        <div class="col-md-4">
                            <label for="Penerbit">Penerbit</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="Penerbit" class="form-control" name="penerbit"
                                placeholder="Penerbit" value="{{ $book->penerbit }}">
                        </div>
                        <div class="col-md-4">
                            <label for="TahunTerbit">Tahun Terbit</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="Tahun Terbit" class="form-control" name="tahun_terbit"
                                placeholder="Tahun Terbit" value="{{ $book->tahun_terbit }}">
                        </div>
                        <div class="col-md-4">
                            <label for="penulis">penulis</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="penulis" id="penulis" class="form-control" name="penulis"
                                placeholder="penulis" value="{{ $book->penulis }}">
                        </div>
                        <div class="col-md-4">
                            <label for="sinopsis">Sinopsis</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" id="sinopsis" rows="3" name="sinopsis" placeholder="Sinopsis......................">{{ $book->sinopsis }}</textarea>
                        </div>
                        <div class="mb-1 col-12">
                            <div class="form-group has-icon-left mandatory">
                                <label for="Kategori" class="form-label">Kategori</label>
                                <div class="position-relative">
                                    <select class="choices form-select" name="kategori_id">
                                        <optgroup label="Kategori">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password-horizontal">Gambar</label>
                        </div>
                        <input type="file" class="image-preview-filepond" value="{{ $book->gambar }}" name="gambar">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset"
                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('adminPage.include.footer')
@include('adminPage.include.script')
