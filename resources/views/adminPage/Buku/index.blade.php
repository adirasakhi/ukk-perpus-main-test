<!-- resources/views/kategori_buku/index.blade.php -->

@extends('layouts.navadmin')

@section('content')
    <div class="container">
        <h2>Daftar Kategori Buku</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('kategori_buku.create') }}" class="btn btn-primary">Tambah Kategori Buku</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('kategori_buku.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kategori_buku.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
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
@endsection
