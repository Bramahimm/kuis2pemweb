# Ini adalah hasil kuis Web Login dan CRUD User, admin PHP Native && Bootstrap 5)

Aplikasi ini merupakan sistem login dan manajemen user sederhana yang dibangun menggunakan **PHP Native**, **MySQL**, dan **Bootstrap 5**. Aplikasi ini cocok untuk latihan atau keperluan kuis/web tugas akhir dasar.

## ✨ Fitur Utama

- ✅ Registrasi User
- ✅ Login User, password di hash
- ✅ Login Admin (password biasa / plaintext)
- ✅ CRUD User (buat, lihat, hapus oleh admin)
- ✅ Upload dan tampilkan foto profil
- ✅ Logout untuk semua role
- ✅ Role-based login (User & Admin)



## 🗂️ Struktur Folder
bisa dilihat diatas

## 🛠️ Struktur Database

### 1. Tabel `users`

```sql

users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    photo VARCHAR(255)
);

admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

