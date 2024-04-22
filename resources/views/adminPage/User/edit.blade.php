@include('adminPage.include.style')
@include('adminPage.include.sidebar')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit User</h3>
                <p class="text-subtitle text-muted">Mengubah User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="/users">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit User</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="username" class="form-control" name="username"
                                placeholder="Username" value="{{ $user->username }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="Email" value="{{ $user->email }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="nama_lengkap">Nama Lengkap</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap"
                                placeholder="Nama Lengkap" value="{{ $user->nama_lengkap }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="alamat" class="form-control" name="alamat"
                                placeholder="Alamat" value="{{ $user->alamat }}" required>
                        </div>
                        <div class="col-md-8 form-group">
                            <label class="form-label">
                                Role
                            </label>
                        </div>
                        <div class="mb-1 col-12">
                            <div class="form-group has-icon-left mandatory">
                                <div class="position-relative">
                                    <select class="choices form-select" name="role" required>
                                        <optgroup label="role">
                                            <option value="petugas">Petugas</option>
                                            <option value="peminjam">Peminjam</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password">Gambar</label>
                        </div>
                        <input type="file" class="image-preview-filepond" required>
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
@include('adminPage.include.footer')

@include('adminPage.include.script')
