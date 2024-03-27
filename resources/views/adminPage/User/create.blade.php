@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah User</h3>
                <p class="text-subtitle text-muted">Menambahkan User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/user">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Menambah User</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="first-name-horizontal">First Name</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="first-name-horizontal" class="form-control" name="fname"
                                placeholder="First Name">
                        </div>
                        <div class="col-md-4">
                            <label for="email-horizontal">Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="email-horizontal" class="form-control" name="email-id"
                                placeholder="Email">
                        </div>
                        <div class="col-md-4">
                            <label for="contact-info-horizontal">Mobile</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="number" id="contact-info-horizontal" class="form-control" name="contact"
                                placeholder="Mobile">
                        </div>
                        <div class="col-md-4">
                            <label for="password-horizontal">Password</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="password" id="password-horizontal" class="form-control" name="password"
                                placeholder="Password">
                        </div>
                        <div class="col-md-8 form-group">
                            <label class="form-label">
                                Role
                            </label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="role" id="role-reader"
                                    value="peminjam">
                                <label class="form-check-label form-label" for="role-reader">
                                    peminjam
                                </label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="role" id="role-officer"
                                    value="petugas">
                                <label class="form-check-label form-label" for="role-officer">
                                    petugas
                                </label>
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
