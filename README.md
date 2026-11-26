# RuangKos — Modul Housekeeper

- **Modul:** Modul C — Housekeeper

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
