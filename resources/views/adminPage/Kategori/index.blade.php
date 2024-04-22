@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kategori</h3>
                <p class="text-subtitle text-muted">Data Seluruh Kategori</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
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
                    Table Kategori
                </h5>
                <a href="{{ route('kategori_buku.create') }}" class="btn btn-primary mb-2">Tambah Kategori</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->nama_kategori }}</td>
                                <td>{{ $category->buku->count() }}</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <a href="{{ route('kategori_buku.edit', $category->id) }}"
                                                class="px-2 pt-2 btn btn-warning">
                                                <dt class="the-icon"><span class="fa-fw select-all fas"></span></dt>
                                            </a>
                                        </div>

                                            <div class="me-2">
                                                <form action="{{ route('kategori_buku.destroy', $category->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"><span data-confirm-genre-destroy="true" class="select-all fa-fw fa-lg fas">
                                        </span></button>
                                                </form>
                                            </div>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Belum ada kategori buku.</td>
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
