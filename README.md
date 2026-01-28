# Aplikasi Arsip Surat 📁✉️

Aplikasi **Arsip Surat** adalah aplikasi berbasis web yang dibangun menggunakan **Laravel** untuk membantu instansi, sekolah, maupun organisasi dalam mengelola arsip surat **masuk** dan **keluar** secara digital, terstruktur, dan aman.

## ✨ Fitur Utama

* 📥 Manajemen **Surat Masuk**
* 📤 Manajemen **Surat Keluar**
* 🗂️ Kategori & klasifikasi surat
* 🔍 Pencarian dan filter surat
* 📎 Upload & penyimpanan file surat (PDF/DOC)
* 👤 Manajemen pengguna & hak akses
* 🕒 Riwayat dan log aktivitas
* 🖨️ Cetak & export data surat

## 🛠️ Teknologi yang Digunakan

* **Framework**: Laravel
* **Bahasa**: PHP
* **Database**: MySQL / MariaDB
* **Frontend**: Blade Template, Bootstrap
* **Authentication**: Laravel Auth
* **Storage**: Local / Public Storage

## 📋 Persyaratan Sistem

Pastikan lingkungan pengembangan Anda memenuhi kebutuhan berikut:

* PHP >= 8.1
* Composer
* MySQL / MariaDB
* Web Server (Apache / Nginx)
* Node.js & NPM (opsional, jika menggunakan asset build)

## ⚙️ Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

1. **Clone repository**

   ```bash
   git clone https://github.com/username/aplikasi-arsip-surat.git
   cd aplikasi-arsip-surat
   ```

2. **Install dependency**

   ```bash
   composer install
   ```

3. **Copy file environment**

   ```bash
   cp .env.example .env
   ```

4. **Generate application key**

   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi database**
   Sesuaikan konfigurasi database pada file `.env`

6. **Migrasi database**

   ```bash
   php artisan migrate
   ```

7. **Jalankan server**

   ```bash
   php artisan serve
   ```

Aplikasi dapat diakses melalui: `http://localhost:8000`


## 📂 Struktur Folder Proyek

Berikut adalah struktur folder utama pada aplikasi ini:

```
app/                    # Logic aplikasi (Controller, Model, dll)
database/               # Migration, Seeder, dan database sqlite
├── migrations/         # File migrasi tabel (surat masuk, surat keluar, nota dinas, dll)
├── seeders/            # DatabaseSeeder
public/                 # File publik
resources/              # Asset dan tampilan aplikasi
├── css/                # File CSS
├── js/                 # File JavaScript
├── views/              # Blade templates
│   ├── auth/           # Halaman autentikasi
│   ├── layouts/        # Layout utama
│   ├── notaDinas/      # CRUD Nota Dinas
│   ├── suratMasuk/     # CRUD Surat Masuk
│   ├── suratKeluar/    # CRUD Surat Keluar
│   ├── user_approval/  # Approval pengguna
│   ├── home.blade.php
│   ├── landing.blade.php
│   └── welcome.blade.php
routes/                 # Routing aplikasi
storage/                # Penyimpanan file surat
```

## 🤝 Kontribusi

Kontribusi sangat terbuka! Silakan lakukan:

1. Fork repository
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 🔐 Keamanan

Jika Anda menemukan celah keamanan, silakan laporkan secara pribadi dan **jangan** membuka issue publik.

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**.

---

Dibuat dengan ❤️ menggunakan Laravel
