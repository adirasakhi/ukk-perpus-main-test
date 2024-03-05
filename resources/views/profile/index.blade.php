<!-- resources/views/profile/index.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    .profile:hover img {
        transform: scale(1.1); /* Membesarkan gambar saat dihover */
    }

    .profile:hover::before {
        content: "Edit Profile"; /* Menampilkan teks "Edit Profile" */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.5); /* Menggelapkan latar belakang */
        padding: 10px 20px;
        border-radius: 5px;
    }
</style>
    <h3 class="text-center">Profile Page</h3>

    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mb-sm-5">
                    <div class="card card-style1 border-0">
                        <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0 text-center"> <!-- Menambahkan class text-center -->
                                    <a href="#" class="profile">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="..." class="border border-4 rounded-1 border-dark py-3">
                                    </a>
                                </div>
                                <div class="col-lg-6 px-xl-10">

                                    <ul class="list-unstyled mb-1-9 text-center"> <!-- Menambahkan class text-center -->
                                        <h3 class="h2 text-dark mb-0">Nama : {{$user->nama_lengkap}}</h3>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Posisi:</span>{{$user->role}}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span>{{$user->email}}</li>
                                        <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Alamat:</span>{{$user->alamat}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        {{-- Modal Untuk edit Foto profile --}}
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Buku</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
<br>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-5">
            <div class="position-relative card table-nowrap table-card">
                <div class="card-header align-items-center">
                    <h5 class="mb-0">Peminjaman terakhir</h5>
                    <p class="mb-0 small text-muted">{{ $notReturnedCount }} Belum dikembalikan</p>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Code Peminjaman</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowings as $borrowing)
                            <tr class="align-middle">
                                <td>#{{ $borrowing->id }}{{ $borrowing->user->id }}{{ $borrowing->buku->id }}{{ now()->format('Ymd') }}</td> <!-- Combined transaction code -->
                                <td>{{ $borrowing->TanggalPeminjaman }}</td>
                                <td>{{ $borrowing->TanggalPengembalian }}</td>
                                <td>{{ $borrowing->buku->judul }}</td> <!-- Assuming 'judul' is the book title column in the 'buku' table -->
                                <td>
                                    @if($borrowing->StatusPeminjaman == 'Dikembalikan' || $borrowing->StatusPeminjaman == 'DikembalikanApprove')
                                        <span class="badge fs-6 fw-normal bg-tint-success text-success">{{ $borrowing->StatusPeminjaman }}</span>
                                    @else
                                        <span class="badge fs-6 fw-normal bg-tint-warning text-warning">{{ $borrowing->StatusPeminjaman }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="/koleksi-pribadi" class="btn btn-gray">Buka Koleksi Pribadi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Saat link dengan class "profile" diklik, tampilkan modal
    $('.profile').click(function() {
        $('#editProfileModal').modal('show');
    });
</script>
@endsection
