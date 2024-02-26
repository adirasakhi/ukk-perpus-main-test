<!-- resources/views/admin/peminjaman/create_ulasan.blade.php -->

@extends('layouts.navadmin')

@section('content')
    <div class="container">
        <h2>Create Ulasan</h2>
        <form action="{{ route('admin.peminjaman.create_ulasan', $peminjaman->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Ulasan" class="form-label">Ulasan</label>
                <textarea class="form-control" id="Ulasan" name="Ulasan" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="Rating" name="Rating" min="1" max="5" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Ulasan</button>
        </form>
    </div>
@endsection
