<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\KoleksiPribadiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriBukuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/show/{id}', [HomeController::class, 'show'])->name('buku.detail');
Route::middleware(['auth', 'admin.petugas'])->group(function () {    // Rute yang memerlukan autentikasi di sini
    // Dashboard admin
    Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout.admin');
});
    // Tutup
    // Grup rute untuk CRUD User
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
    // Akhir grup untuk CRUD User
    // Grup rute untuk CRUD Kategori_buku
Route::prefix('kategori-buku')->group(function () {
    Route::get('/', [KategoriBukuController::class, 'index'])->name('kategori_buku.index');
    Route::get('/create', [KategoriBukuController::class, 'create'])->name('kategori_buku.create');
    Route::post('/store', [KategoriBukuController::class, 'store'])->name('kategori_buku.store');
    Route::get('/edit/{id}', [KategoriBukuController::class, 'edit'])->name('kategori_buku.edit');
    Route::put('/update/{id}', [KategoriBukuController::class, 'update'])->name('kategori_buku.update');
    Route::delete('/destroy/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori_buku.destroy');
});
    // Akhir grup CRUD Kategori_buku
    // Grup rute untuk CRUD Buku
Route::prefix('buku')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('buku.index');
    Route::post('/store', [BookController::class, 'store'])->name('buku.store');
    Route::get('/edit/{id}', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('/update/{id}', [BookController::class, 'update'])->name('buku.update');
    Route::delete('/destroy/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
});
Route::get('/create', [BookController::class, 'create'])->name('buku.create');
    // Akhir grup untuk CRUD Buku
Route::prefix('peminjaman')->group(function () {
    Route::get('/create', [AdminPeminjamanController::class, 'createPeminjamanForm'])->name('admin.peminjaman.create');
    Route::post('/create', [AdminPeminjamanController::class, 'createPeminjaman'])->name('admin.peminjaman.store');
    Route::get('/', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
});

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/koleksi-pribadi', [KoleksiPribadiController::class, 'index'])->name('koleksi_pribadi.index');
    Route::post('/pengembalian-buku/{id}', [PeminjamanController::class, 'kembalikanBuku'])->name('pengembalian.buku');
    Route::post('/profile/upload-photo/{id}', [ProfileController::class, 'uploadPhoto'])->name('profile.upload.photo');
        // Route untuk mengedit ulasan buku
        Route::post('/show/{id}/review', [HomeController::class, 'postReview'])->name('review');
        Route::post('review/{user_id}/{peminjaman_id}/update', [HomeController::class, 'updateReview'])->name('review.update');
        Route::delete('/review/{id}/delete', [HomeController::class, 'deleteReview'])->name('review.delete');


});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/buku/{id}', [BookController::class, 'show'])->name('buku.show');
Route::post('/pinjam/{id}', [PeminjamanController::class, 'pinjamBuku'])->name('pinjam.buku');

Route::get('/test', function () {
    return view('adminPage.home');
});