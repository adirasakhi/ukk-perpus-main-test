<!-- resources/views/kategori_buku/create.blade.php -->

@extends('layouts.navadmin')

@section('content')
    <div class="container">
        <h2>Tambah Kategori Buku</h2>

        <form action="{{ route('kategori_buku.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
