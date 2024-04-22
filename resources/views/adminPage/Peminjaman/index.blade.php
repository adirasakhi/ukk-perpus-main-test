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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
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
            <a href="{{ route('admin.peminjaman.create') }}" type="button">Tambah Peminjaman</a>
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
            @foreach ($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->id }}</td>
                    <td>{{ $peminjaman->user->nama_lengkap }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->TanggalPeminjaman }}</td>
                    <td>{{ $peminjaman->TanggalPengembalian }}</td>
                    <td>{{ $peminjaman->StatusPeminjaman }}</td>
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
                @endforeach
        </tbody>
    </table>
</div>
@include('adminPage.include.footer')
@include('adminPage.include.script')
