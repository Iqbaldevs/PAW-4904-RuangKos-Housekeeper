# RuangKos — Modul Housekeeper

Aplikasi web manajemen properti kos (**RuangKos**) berbasis Laravel 12. Repositori ini memuat kontribusi pengerjaan **Modul C: Manajemen Housekeeper (Katalog Petugas Kebersihan)**.

- **Nama:** Muhammad Iqbal Mahyuddin
- **Kelas:** SI-49-04
- **Modul:** Modul C — Housekeeper

---

## Ringkasan Fitur & Hak Akses
- **Admin (`role: admin`):** Dapat melihat daftar staf, melihat detail penugasan, menambahkan staf baru, mengubah data, serta menghapus data staf kebersihan (CRUD penuh).
- **Penghuni (`role: penghuni`):** Dapat melihat daftar petugas kebersihan, tugas, dan area kerja serta menggunakan fitur pencarian dan filter area (*read-only*).

---

## Struktur Folder & File yang Dikerjakan

```text
RuangKos-Housekeeper/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── HousekeeperController.php                    # [File Baru] Logika CRUD, pencarian, & filter area
│   └── Models/
│       └── Housekeeper.php                                  # [File Baru] Model Eloquent tabel housekeepers
├── database/
│   └── migrations/
│       └── 2026_11_25_145627_create_housekeepers_table.php  # [File Baru] Skema tabel housekeepers
├── resources/
│   └── views/
│       ├── housekeepers/                                    # [Folder Baru] Seluruh tampilan antarmuka modul
│       │   ├── index.blade.php                              # Halaman utama katalog, statistik, & filter
│       │   ├── form.blade.php                               # Formulir tambah & ubah data staf
│       │   └── show.blade.php                               # Halaman detail penugasan staf
│       └── partials/
│           └── sidebar.blade.php                            # [Diperbarui] Penambahan menu & active state Housekeeper
└── routes/
    └── web.php                                              # [Diperbarui] Konfigurasi rute & middleware peran Modul C
```

---

## Cara Menjalankan di Lokal
1. Jalankan `composer install` dan salin `.env.example` menjadi `.env`.
2. Jalankan `php artisan key:generate` dan `php artisan migrate`.
3. Jalankan server lokal dengan `php artisan serve`, lalu akses melalui `http://localhost:8000`.
