<h1 align="center">Proyek UKK perpus Adira</h1>

---

<h2 id="tentang">Konsep web apa yang saya buat?</h2>

Sebuah platform perpustakaan digital yang memukau, menampilkan desain modern yang teratur. Halaman ini menonjolkan bagian utama dengan deskripsi layanan, ulasan, dan navigasi lokasi yang mudah digunakan.

<h2 id="fitur">Fitur apa saja sih yg digunakan pada proyek ini?</h2>

-   [Mazer Bootstrap Template](https://github.com/zuramai/mazer)
    -   Mode gelap dan mode terang 
    -   Dashboard UI
-   Halaman Awal (Landing Page)
    -   Halaman Beranda
    -   Buku
    -   Kategori Buku
-   Authentication
    -   register
    -   Login
-   Multi User
    -   Admin
        -   Pengguna yang dapat dikelola 
        -   Buku yang dapat dikelola
        -   Kategori buku yang dapat dikelola
        -   Melihat semua data
        -   Generate Laporan (EXCEL, CSV, HTML, PDF)
    -   Petugas
        -   Buku yang dapat di kelola
        -   Kategori Buku yang dapat di kelola
        -   Melihat semua data
        -   Generate Laporan (EXCEL, CSV, HTML, PDF)
    
    -   -   Peminjam / Pembaca
        -   Mencari buku
        -   Memberikan Rating dan Ulasan buku
        -   Melihat peminjaman buku mereka sendiri
        -   Register (membuat akun sebagai peminjam)
    -   Semua
        -   Mengulas buku di Halaman Show Buku
        -   Login
        -   Logout
-   Pencarian Halaman Awal (Landing Page)
    -   Buku
    -   kategori buku
    
    <h2 id="testing-account">Akun Default untuk Pengujian</h2>
    
    ### Admin

-   Nama Pengguna: admin
-   Kata Sandi: 123

    ### Petugas

-   Nama Pengguna: adira
-   Kata Sandi: 123

      Peminjam

-   Nama Pengguna: dxx
-   Kata Sandi: 123


<h2 id="demo"> ERD & Relasi antar tabel</h2>

![ERD](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/erd.png?raw=true)

![RAT](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/relasiantartabel2.png?raw=true)

Tabel Failed_Jobs, Personal_access_tokens, Password_reset_tokens, migrations abaikan saja karna bawaan dari Laravel.


<h2 id="demo"> UML Diagram Use Case</h2>

![UML](https://github.com/adirasakhi/ukk-perpus-main-test/blob/main/uml.png?raw=true)


<h2 id="pre-requisite"> Prasyarat</h2>

<p>Berikut adalah prasyarat yang diperlukan untuk menginstal dan menjalankan aplikasi.</p>

-   PHP 8.2.8 & Web Server (Apache, Lighttpd, atau Nginx)
-   Database (MariaDB dengan v11.0.3 atau PostgreSQL)
-   Web Browser (Firefox, Safari, Opera, dll)

<h2 id="installation">💻 Instalasi</h2>

<h3 id="develop-yourself"> Mengembangkan Sendiri</h3>
1. Klona repositori

```bash
git clone https://github.com/adirasakhi/ukk-perpus-main-test.git
cd ukk-perpus-main-test
composer install
npm install
cp .env.example .env
```
2. Konfigurasi database melalui file `.env`

```conf
APP_DEBUG=true
DB_DATABASE=perpus1
DB_USERNAME=nama-pengguna-anda
DB_PASSWORD=kata-sandi-anda
```

3. Migrasi dan symlink

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate --seed

4. Mulai situs web

```bash
npm run dev
# Jalankan di terminal yang berbeda
php artisan serve
```

<p>perpus-v2 dibuat oleh <a href="https://instagram.com/adrshki">Adira</a>.</p>

