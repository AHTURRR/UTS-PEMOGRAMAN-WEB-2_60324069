## 👤 Identitas Mahasiswa
- **Nama:** Ahmad Turmudi
- **NIM:** 60324069
- **Program Studi:** Informatika, UIN K.H. Abdurrahman Wahid Pekalongan

## 📝 Deskripsi Singkat Aplikasi
Aplikasi ini adalah sistem CRUD (Create, Read, Update, Delete) sederhana yang dibangun menggunakan PHP Native (MySQLi) dan antarmuka Bootstrap 5. Aplikasi ini ditujukan untuk memenuhi tugas Ujian Tengah Semester (UTS) dengan studi kasus pengelolaan data master **Kategori Buku** pada sebuah sistem informasi perpustakaan. 

Fitur unggulan dari aplikasi ini meliputi:
- Penggunaan **Prepared Statements** pada semua *query* database untuk mencegah celah keamanan *SQL Injection*.
- Validasi data *server-side* yang ketat (pengecekan format kode kategori, batasan karakter, hingga validasi duplikasi data).
- *User Interface* yang responsif, rapi, dan mudah digunakan.

## 🚀 Cara Instalasi dan Menjalankan Aplikasi

1. **Persiapan Server Lokal:** Pastikan aplikasi server lokal seperti Laragon atau XAMPP sudah terinstal dan berjalan (jalankan service Apache dan MySQL).
2. **Penempatan File:** *Clone* atau *download* repository ini, lalu ekstrak/letakkan ke dalam folder *document root* kamu:
   - Jika menggunakan Laragon: letakkan di `C:\laragon\www\`
3. **Persiapan Database:**
   - Buka browser dan akses phpMyAdmin (`http://localhost/phpmyadmin`).
   - Buat database baru dengan nama `uts_perpustakaan_60324069`.
   - Buat tabel `kategori` beserta strukturnya (atau *import* file `.sql` jika sudah kamu sediakan).
4. **Konfigurasi:** Pastikan file `config/database.php` sudah disesuaikan dengan *username* (biasanya `root`) dan *password* database lokal kamu.
5. **Jalankan Aplikasi:** Buka browser dan akses aplikasi melalui URL: `http://localhost/nama_folder_kamu/index.php`.

## 📁 Struktur Folder
```text
📦 folder-project-uts/
 ┣ 📂 config/
 ┃ ┗ 📜 database.php      # File konfigurasi koneksi database MySQLi
 ┣ 📜 index.php           # Halaman utama, menampilkan tabel data & tombol aksi (Read)
 ┣ 📜 create.php          # Halaman form dan proses tambah kategori baru (Create)
 ┣ 📜 edit.php            # Halaman form pre-filled dan proses ubah data (Update)
 ┣ 📜 delete.php          # File pemroses aksi hapus data (Delete)
 ┗ 📜 README.md           # File dokumentasi informasi project