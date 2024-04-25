# 📚 Proyek UKK Perpus Adira

## 🖼️ Preview

### ERD (Diagram Entitas Hubungan)

![ERD](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/erd.png?raw=true)

### UML Diagram Use Case

![UML](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/uml.png?raw=true)

### Halaman Utama

![Preview-1](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/preview-1.png?raw=true)

### Halaman Show/Tampilan Buku

![Preview-2](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/preview-2.png?raw=true)

### Halaman Profile

![Preview-3](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/preview-3.png?raw=true)

### Halaman Koleksi Pribadi

![Preview-4](https://github.com/adirasakhi/ukk-perpus-main-test/blob/master/preview-4.png?raw=true)

---

## 🎨 Konsep Desain

Sebuah platform perpustakaan digital yang memukau, menampilkan desain modern yang teratur. Halaman ini menonjolkan bagian utama dengan deskripsi layanan, ulasan, dan navigasi lokasi yang mudah digunakan.

## 🚀 Fitur Unggulan

- **Mazer Bootstrap Template**
  - Mode gelap dan terang
  - Dashboard UI

### Halaman Awal (Landing Page)

- Halaman Beranda
- Daftar Buku
- Kategori Buku

### Autentikasi

- Registrasi
- Login

### Multi User

#### Admin

- Kelola Pengguna, Buku, dan Kategori Buku
- Lihat semua data
- Generate Laporan (EXCEL, CSV, HTML, PDF)

#### Petugas

- Kelola Buku dan Kategori Buku
- Lihat semua data
- Generate Laporan (EXCEL, CSV, HTML, PDF)

#### Peminjam

- Cari buku
- Berikan Rating dan Ulasan buku
- Lihat peminjaman buku mereka sendiri
- Registrasi sebagai peminjam

### Pencarian

- Buku
- Kategori buku

## 🛠️ Instalasi

### Persyaratan

- PHP 8.2.8 & Web Server (Apache, Lighttpd, atau Nginx)
- Database (MariaDB v11.0.3 atau PostgreSQL)
- Web Browser (Firefox, Safari, Opera, dll)

### Langkah-langkah

1. **Klon Repositori**

    ```bash
    git clone https://github.com/adirasakhi/ukk-perpus-main-test.git
    cd ukk-perpus-main-test
    composer install
    npm install
    cp .env.example .env
    ```

2. **Konfigurasi Database**

    ```conf
    APP_DEBUG=true
    DB_DATABASE=perpus1
    DB_USERNAME=nama-pengguna-anda
    DB_PASSWORD=kata-sandi-anda
    ```

3. **Migrasi dan Symlink**

    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan migrate --seed
    ```

4. **Mulai Situs Web**

    ```bash
    npm run dev
    # Jalankan di terminal yang berbeda
    php artisan serve
    ```

perpus-v2 dibuat oleh [Adira](https://instagram.com/adrshki_/).

