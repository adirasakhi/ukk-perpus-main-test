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
                <a href="/tambahUser" type="button">tambah User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive datatable-minimal">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Graiden</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>076 4820 8838</td>
                                <td>Offenburg</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
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
