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
                    Table Peminjam
                </h5>
                <a href="/tambahBuku" type="button">tambah Buku</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
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
                            <tr>
                                <td><img src="{{ asset('mazer/assets/compiled/svg/favicon.svg') }}" alt=""></td>
                                <td>Graiden</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>2021</td>
                                <td>Offenburg</td>
                                <td>action</td>
                                <td>4</td>
                                <td>1</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <a href="#"
                                                class="px-2 pt-2 btn btn-warning">
                                                <span class="select-all fa-fw fa-lg fas"></span>
                                            </a>
                                        </div>

                                            <div class="me-2">
                                                <a class="px-2 pt-2 btn btn-danger" data-confirm-genre-destroy="true">
                                                    <span data-confirm-genre-destroy="true" class="select-all fa-fw fa-lg fas"></span>
                                                </a>
                                            </div>
                                            <div class="me-2">
                                                <a class="px-2 pt-2 btn btn-success" data-confirm-genre-activate="true">
                                                    <span data-confirm-genre-activate="true" class="select-all fa-fw fa-lg fas"></span>
                                                </a>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- Minimal jQuery Datatable end -->

@include('adminPage.include.script')
