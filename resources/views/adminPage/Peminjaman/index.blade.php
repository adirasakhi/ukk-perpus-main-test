@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Peminjaman</h3>
                <p class="text-subtitle text-muted">Data Seluruh Peminjaman</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Table Peminjaman
            </h5>
            <a href="/tambahUser" type="button">Tambah Peminjaman</a>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table" id="table2">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>1</td>
                    <td>Lorem, ipsum.</td>
                    <td>Lorem, ipsum dolor.</td>
                    <td>2021</td>
                    <td>2025</td>
                    <td>Dikembalikan</td>
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
                        {{-- @if ($peminjaman->StatusPeminjaman == 'Dipinjam')
                            <a href=""
                                class="btn btn-success">Dipinjam</a>
                        @elseif ($peminjaman->StatusPeminjaman == 'Dikembalikan')
                        <a href=""
                        class="btn btn-success">Dikembalikan</a>
                        @endif --}}
                    </td>
                </tr>
        </tbody>
    </table>
</div>
@include('adminPage.include.script')
