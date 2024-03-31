<!-- resources/views/admin/kategori_buku/edit.blade.php -->

@extends('layouts.navadmin')

@section('content')
    <div class="container">
        <h2>Edit Kategori Buku</h2>

        <form action="{{ route('kategori_buku.update', $kategoriBuku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategoriBuku->nama_kategori }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
