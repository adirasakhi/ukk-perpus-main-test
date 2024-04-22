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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
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
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Tambah User Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->nama_lengkap }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <a href="{{ route('users.show', $user->id) }}"
                                                class="px-2 pt-2 btn btn-success">
                                                <span class="select-all fa-fw fa-lg fas">show</span>
                                            </a>
                                        </div>

                                            <div class="me-2">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                                </form>
                                            </div>
                                            <div class="me-2">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada user.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- Minimal jQuery Datatable end -->
@include('adminPage.include.footer')
@include('adminPage.include.script')
