<!-- resources/views/admin/peminjaman/index.blade.php -->

@extends('layouts.navadmin')

@section('content')
    <div class="container">
        <h2>Daftar Peminjaman</h2>
        <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>

        <table class="table">
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
                            @if ($peminjaman->StatusPeminjaman == 'Dipinjam')
                                <a href="{{ route('admin.peminjaman.create_ulasan', $peminjaman->id) }}"
                                    class="btn btn-success">Tambah Ulasan</a>
                            @else
                                <span class="text-muted">Tidak Tersedia</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
