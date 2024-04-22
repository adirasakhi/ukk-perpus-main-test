@extends('layouts.main')

@section('content')
{{-- Style Img Viewer --}}
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/filepond/filepond.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/extensions/toastify-js/src/toastify.css') }}">
{{-- end Style Img Viewer --}}
{{-- profile --}}
<div class="max-w-2xl mx-auto mt-5 bg-base-100 shadow-xl rounded-lg text-white-900">
    <div class="rounded-t-lg overflow-hidden">
        <img class="w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
    </div>
    <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden shadow-xl">
        @if($user->foto)
        <img class="object-cover " src="{{ asset('storage/profile_photos/' . $user->foto) }}" alt="Profile">
    @else
        <img class="object-cover h-35 w-32" src="{{ asset('images/undraw_profile_2.svg') }}" alt="Profile">
    @endif
    </div>
    <div class="text-center mt-2">
        <h2 class="font-semibold text-xl">{{$user->nama_lengkap}}</h2>
        <p class="text-white-500">{{$user->role}}</p>
        <ul class="list-unstyled mb-1-9 text-center"> <!-- Menambahkan class text-center -->

            <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span>{{$user->email}}</li>
            <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Alamat:</span>{{$user->alamat}}</li>
        </ul>
    </div>
    <ul class="py-4 mt-2 text-white-700 flex items-center justify-around">
        <li class="flex flex-col items-center justify-around">
            <div>Total Peminjaman Buku</div>
            <p class="text-white-500">{{$borrowings->count()}}</p>

        </li>
        <li class="flex flex-col items-center justify-between">
            <div>Buku Yang Sedang Dipinjam</div>
            <p class="text-white-500">{{ $notReturnedCount }}</p>

        </li>
    </ul>
    <div class="p-4 border-t mx-8 mt-2">
        <button class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2 " onclick="editmodal.showModal()">Edit</button>
    </div>
</div>
<dialog id="editmodal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-10">Edit Profile</h3>
        <form action="{{ route('profile.upload.photo', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="username" class="block mb-2 text-sm font-medium text-white-900 dark:text-white">Username</label>
                <input type="username" id="username" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="username" value="{{ $user->username }}" required />
              </div>
              <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-white-900 dark:text-white">Email</label>
                <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="email" value="{{ $user->email }}" required />
              </div>
              <div class="mb-5">
                <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-white-900 dark:text-white">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="nama_lengkap" value="{{ $user->nama_lengkap }}" required />
              </div>
              <div class="mb-5">
                <label for="alamat" class="block mb-2 text-sm font-medium text-white-900 dark:text-white">Alamat</label>
                <input type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="alamat" value="{{ $user->alamat }}" required />
              </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-white-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="password-horizontal">Gambar</label>
            </div>
            <input type="file" class="image-preview-filepond" id="foto" name="foto">
            <button type="submit" class="btn btn-primary mt-10">Unggah foto</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
      </form>
</dialog>
{{-- end Profile --}}
{{-- Script Image Viewer --}}
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/filepond/filepond.js') }}"></script>
<script src="{{ asset('mazer/assets/extensions/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('mazer/assets/static/js/pages/filepond.js') }}"></script>
{{-- end Script Image Viewer --}}
@endsection
