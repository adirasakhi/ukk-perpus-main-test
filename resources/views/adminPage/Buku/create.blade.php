@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Buku</h3>
                <p class="text-subtitle text-muted">Menambahkan Buku</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/buku">Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Menambah Buku</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="first-name-horizontal">Judul Buku</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="first-name-horizontal" class="form-control" name="fname"
                                placeholder="First Name">
                        </div>
                        <div class="col-md-4">
                            <label for="email-horizontal">Penerbit</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="email-horizontal" class="form-control" name="email-id"
                                placeholder="Email">
                        </div>
                        <div class="col-md-4">
                            <label for="contact-info-horizontal">Tahun Terbit</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="contact-info-horizontal" class="form-control" name="contact"
                                placeholder="Mobile">
                        </div>
                        <div class="col-md-4">
                            <label for="penulis-horizontal">penulis</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="penulis" id="penulis-horizontal" class="form-control" name="penulis"
                                placeholder="penulis">
                        </div>

                        <div class="mb-1 col-12">
                            <div class="form-group has-icon-left mandatory">
                                <label for="genres" class="form-label">Kategori</label>
                                <div class="position-relative">
                                    <select id="genres" class="choices form-select multiple-remove"
                                        multiple="multiple" name="genres[]">
                                        <option placeholder>Pilih Kategori ...</option>
                                        <option value="test">test</option>
                                        <option value="test1">test</option>
                                        <option value="test2">test</option>
                                    </select>

                                    {{-- @error('genres')
                                        <div style="margin-top: -20px" class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password-horizontal">Gambar</label>
                        </div>
                        <input type="file" class="image-preview-filepond">
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

@include('adminPage.include.script')
