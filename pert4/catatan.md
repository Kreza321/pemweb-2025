
# Pertemuan 3 - Pemrograman Web

**Tanggal:** Senin, 14 April 2025

**Waktu:** 13.00 - 17.00

### Langkah-langkah:

1. #### **Masuk ke Folder Perkuliahan**


   * Buka terminal dan masuk ke direktori `perkuliahan/pemrograman-web`.
   * Buka Navicat dan Docker.
2. #### **Membuat Folder Pertemuan 3**


   * Buat folder `pertemuan-3` untuk menyimpan file pertemuan hari ini.
3. #### **Mengunduh File dari GitHub**


   * Buka repository GitHub: [https://github.com/djambred/pemweb-gen2024/tree/main](https://github.com/djambred/pemweb-gen2024/tree/main)
   * Masuk ke folder `pert 3`, lalu salin semua folder dan file ke dalam folder `pertemuan-3` di lokal.
4. #### **Setup Proyek dengan Docker dan Composer**


   * Kembali ke terminal, jalankan perintah:
     ```bash
     docker exec -it pemweb bash
     ```
   * Di dalam container, buat project Laravel Fila Starter:
     ```bash
     composer create-project --prefer-dist raugadh/fila starter .
     ```
   * Jika koneksi gagal:
     ```bash
     rm -rf *
     rm -rf .*  # untuk menghapus file tersembunyi kecuali "." dan ".."
     ```
   * Ubah hak akses folder:
     ```bash
     chown -R www-data storage/*
     ```
5. #### **Edit Konfigurasi Environment**


   * Buka file `.env` di folder `src`, lalu ubah konfigurasi berikut:
     * `APP_NAME=pemweb`
     * `APP_TIMEZONE=Asia/Jakarta`
     * `APP_URL=http://localhost`
     * `DB_CONNECTION=mysql`
     * `DB_DATABASE=db_pemweb`
     * `DB_USERNAME=root`
     * `DB_PASSWORD=p455w0rd`
6. #### **Menjalankan Migrasi dan Seeder**

   Jalankan perintah berikut secara berurutan di terminal (dalam container Docker):


   ```bash
   php artisan migrate:fresh
   php artisan db:seed --force
   php artisan shield:generate --all
   php artisan project:init
   chmod 777 -R storage/* && chmod 777 -R bootstrap/*
   ```
7. #### **Menambahkan Folder dan File Livewire**


   * Di folder `app`, buat folder `Livewire`, lalu buat file `ShowHomePage.php` di dalamnya.
   * Di folder `resources`, buat struktur sebagai berikut:
     * `views/components/layouts/app.blade.php`
     * `views/livewire/show-home-page.blade.php`
   * Ubah file `web.php` yang ada di folder `routes` untuk mengarahkan ke komponen Livewire `ShowHomePage`.
8. #### **Akses Navicat**


   * Buka Navicat dan buat koneksi baru dengan pengaturan berikut:
     * **Connection Name:** wsl-localhost
     * **Host:** localhost
     * **Port:** 13306
     * **User:** root
     * **Password:** p455w0rd
   * Klik "Test Connection". Jika berhasil, klik OK.
9. #### **Akses Proyek**


   * Buka browser dan akses `http://localhost` untuk melihat hasil proyek Laravel dengan starter Fila yang sudah di-setup.
10. #### **Menambah Fitur dalam Localhost**

* Kembali ke terminal dan jalankan perintah untuk membuat komponen Livewire baru:
  ```bash
  php artisan make:livewire ShowProfile
  ```
* Buka Visual Studio Code dan ubah kode di file `app.blade.php`, serta sesuaikan `web.php` untuk menambahkan route menuju halaman `ShowProfile`.

### Teknologi yang Digunakan

* Laravel 10 + Fila Starter
* Composer
* Docker & Docker Compose
* Nginx
* MySQL

### Catatan Tambahan

Pastikan koneksi internet stabil saat `composer create-project`. Periksa juga apakah container `pemweb` sedang berjalan sebelum masuk menggunakan `docker exec`. Setelah `project:init`, proyek siap digunakan dan dapat dikembangkan lebih lanjut. Semua folder dan file hasil latihan disimpan di dalam `pertemuan-3`.
