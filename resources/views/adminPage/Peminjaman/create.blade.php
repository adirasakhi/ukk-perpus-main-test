@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Peminjaman</h3>
                <p class="text-subtitle text-muted">Menambahkan Peminjaman</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/peminjaman">Peminjaman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.peminjaman.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-select" id="user_id" name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select class="form-select" id="buku_id" name="buku_id" required>
                @foreach ($buku as $b)
                    <option value="{{ $b->id }}">{{ $b->judul }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
    </form>
</div>
@include('adminPage.include.footer')
@include('adminPage.include.script')
