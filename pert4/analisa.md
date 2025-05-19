# Analisis 5W+1H dan SWOT

## Analisis Teknologi (SWOT)

| Komponen         | Kekuatan (Strengths)                | Kelemahan (Weaknesses)           | Peluang (Opportunities)               | Ancaman (Threats)                        |
| ---------------- | ----------------------------------- | -------------------------------- | ------------------------------------- | ---------------------------------------- |
| Laravel + Fila   | Modern, modular, cepat dikembangkan | Perlu resource tinggi            | Cocok untuk SPA & Admin Panel         | Ketergantungan pada package pihak ketiga |
| Composer         | Manajemen dependensi yang efisien   | Harus paham CLI                  | Mendukung banyak package PHP          | Masalah jika koneksi internet lambat     |
| Docker & Compose | Portabilitas & isolasi lingkungan   | Kurva belajar untuk pemula       | Memudahkan deployment lintas platform | Overhead sistem bila spek rendah         |
| Nginx            | Ringan dan cepat untuk web server   | Kurang familiar dibanding Apache | Cocok untuk produksi & reverse proxy  | Konfigurasi awal bisa membingungkan      |
| MySQL            | Populer dan banyak didukung         | Skalabilitas kompleks            | Komunitas luas, GUI tools banyak      | Kurang optimal untuk big data            |

---

## 5W + 1H

### Laravel + Fila

* **What**: Framework PHP modern untuk pengembangan web.
* **Why**: Mempermudah pengembangan dengan fitur lengkap dan struktur modular.
* **Who**: Digunakan oleh developer web yang butuh hasil cepat.
* **Where**: Server lokal atau cloud hosting.
* **When**: Saat membangun aplikasi web berbasis komponen.
* **How**: Menggunakan perintah Artisan dan fitur bawaan Laravel & Fila.

### Composer

* **What**: Dependency manager untuk PHP.
* **Why**: Mengelola library dan update package dengan efisien.
* **Who**: Developer PHP.
* **Where**: Digunakan di proyek berbasis PHP.
* **When**: Saat membutuhkan package/library pihak ketiga.
* **How**: Dengan CLI dan file `<span>composer.json</span>`.

### Docker & Docker Compose

* **What**: Platform untuk menjalankan aplikasi dalam container.
* **Why**: Menjamin keserag  n xaman environment antar tim/devices.
* **Who**: Developer dan DevOps.
* **Where**: Lokal maupun cloud (CI/CD).
* **When**: Saat perlu lingkungan development yang konsisten.
* **How**: Menggunakan `<span>Dockerfile</span>`, `<span>docker-compose.yml</span>`, dan perintah docker.

### Nginx

* **What**: Web server dan reverse proxy.
* **Why**: Ringan dan cepat.
* **Who**: Sysadmin dan web developer.
* **Where**: Server lokal atau produksi.
* **When**: Saat membutuhkan performa tinggi untuk serving web.
* **How**: Dengan konfigurasi file `<span>nginx.conf</span>`.

### MySQL

* **What**: Sistem manajemen basis data relasional.
* **Why**: Stabil, populer, dan banyak dokumentasi.
* **Who**: Semua yang mengelola data.
* **Where**: Server lokal dan produksi.
* **When**: Saat menyimpan dan mengelola data terstruktur.
* **How**: Melalui query SQL, GUI seperti Navicat, atau CLI.

## ELEMEN MASING - MASING

### Laravel 10 + Fila Starter

* **Laravel** : Framework PHP modern yang menyediakan fitur lengkap untuk pengembangan aplikasi web.
* **Fila Starter** : Template Laravel berbasis Livewire + Filament Admin, digunakan untuk membuat antarmuka admin modern secara cepat.

### Composer

* Alat manajemen dependensi PHP. Memudahkan pengelolaan package/library pihak ketiga dalam proyek Laravel.

### Docker & Docker Compose

* **Docker** : Platform untuk membuat, mengirim, dan menjalankan aplikasi dalam container.
* **Docker Compose** : Alat untuk mengatur banyak container sekaligus (seperti Laravel, MySQL, Nginx) dalam satu file konfigurasi.

### Nginx

* Web server ringan dan cepat yang digunakan untuk menyajikan aplikasi web ke pengguna, serta berfungsi sebagai reverse proxy.

### MySQL

* Sistem manajemen database relasional (RDBMS) yang digunakan untuk menyimpan dan mengelola data aplikasi.
