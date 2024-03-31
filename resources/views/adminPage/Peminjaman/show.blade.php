
@extends('layouts.navadmin')

@section('content')
    <h2>Detail User</h2>

    <div>
        <strong>ID:</strong> {{ $user->id }}<br>
        <strong>Username:</strong> {{ $user->username }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Nama Lengkap:</strong> {{ $user->nama_lengkap }}<br>
        <strong>Alamat:</strong> {{ $user->alamat }}<br>
        <strong>Role:</strong> {{ $user->role }}<br>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
