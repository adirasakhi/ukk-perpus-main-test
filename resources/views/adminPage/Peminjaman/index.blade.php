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
            <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary mb-2">Tambah Peminjaman</a>
            <div class="dropdown items-end ms-auto">
                    <button class="btn btn-success dropdown-toggle me-1" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Exports
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"> <!-- Mengubah class dropdown-menu-end agar dropdown berada di kanan -->
                        <a class="dropdown-item" href="{{ route('export_peminjaman.excel') }}">Excel</a>
                        <a class="dropdown-item" href="{{ route('export_peminjaman.pdf') }}">Pdf</a>
                        <a class="dropdown-item" href="{{ route('export_peminjaman.csv') }}">Csv</a>
                    </div>
                </div>
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
                                <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak serta menghapus data peminjaman ini?')"><span data-confirm-genre-destroy="true" class="select-all fa-fw fa-lg fas">
                                        </span></button>
                                                </form>
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
