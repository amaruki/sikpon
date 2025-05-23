# Sistem Informasi Manajemen Pondok Pesantren

Aplikasi ini adalah sistem informasi manajemen untuk pondok pesantren yang mengelola data akademik, administratif, dan komunikasi antara pihak pesantren dengan wali murid. Sistem ini dirancang dengan hierarki akses bertingkat untuk memastikan keamanan dan pembagian tugas yang tepat.

---

## Struktur Folder

```
app/
├── Console/           # Console commands
├── Exceptions/        # Exception handlers
├── Http/             # HTTP layer
│   ├── Controllers/  # Application controllers
│   └── Middleware/   # HTTP middleware
├── Models/           # Eloquent models
│   ├── Hari.php
│   ├── Informasis.php
│   ├── Jadwal.php
│   ├── Kelas.php
│   ├── Kurikulum.php
│   ├── Mapel.php
│   ├── Nilai.php
│   ├── Pegawai.php
│   ├── Raport.php
│   ├── Siswa.php
│   ├── Tahun.php
│   └── User.php
├── Providers/        # Service providers
└── Traits/          # Shared traits

config/              # Configuration files
├── app.php
├── auth.php
├── database.php
└── ...

database/
├── factories/        # Model factories
├── migrations/       # Database migrations
└── seeders/         # Database seeders

public/             # Publicly accessible files
├── css/
├── js/
├── frontend/
└── informasi_foto/

resources/
├── css/
├── js/
├── lang/           # Language files
├── sass/
└── views/          # Blade templates

routes/             # Route definitions
├── api.php
├── channels.php
├── console.php
└── web.php

storage/           # Application storage
├── app/
├── framework/
└── logs/

tests/            # Application tests
├── Feature/
└── Unit/
```

## Arsitektur Sistem

### 1. Role-Based Access Control (RBAC)

- **Admin**: Memiliki akses penuh untuk mengelola seluruh aspek sistem  
- **Guru**: Memiliki akses terbatas untuk fungsi pengajaran dan evaluasi  
- **Wali Murid**: Hanya memiliki akses untuk memonitor perkembangan anak  

---

### 2. Modul Utama Aplikasi

#### A. Modul Manajemen Pengguna

- **Pengelolaan Data Santri**: Biodata, riwayat pendidikan, data keluarga  
- **Pengelolaan Data Guru**: Profil pengajar, kualifikasi, mata pelajaran yang diampu  
- **Manajemen User**: Pengaturan akun, password, dan hak akses  

#### B. Modul Akademik

- **Kurikulum**:
  - Rancangan pembelajaran tahunan  
  - Standar kompetensi dan kompetensi dasar  
  - Distribusi materi per semester/cawu  
  - Target pencapaian pembelajaran  

- **Jadwal Pelajaran**:
  - Penjadwalan harian/mingguan  
  - Alokasi guru per mata pelajaran  
  - Pengaturan waktu dan tempat belajar  

#### C. Modul Evaluasi dan Monitoring

- **Jurnal Pembelajaran**:
  - Laporan evaluasi mingguan  
  - Catatan perkembangan santri  
  - Dokumentasi kegiatan pembelajaran  
  - Progress pencapaian kurikulum  

---

## Fitur Detail Per Role

### ADMIN (Super User)

**Fungsi Strategis:**

- Kontrol penuh sistem  
- Perencanaan dan kebijakan akademik  
- Pengawasan operasional keseluruhan  

**Fitur Khusus:**

- Dashboard analytics dan reporting  
- Backup dan restore data  
- Konfigurasi sistem  
- Audit log aktivitas pengguna  

---

### GURU (Operator Akademik)

**Fungsi Operasional:**

- Pelaksana pembelajaran langsung  
- Evaluator perkembangan santri  
- Input data akademik real-time  

**Batasan Akses:**

- Tidak dapat menghapus data master (guru, kurikulum, jadwal)  
- Tidak dapat mengelola user admin  
- Fokus pada data santri dan jurnal pembelajaran  

---

### WALI MURID (End User)

**Fungsi Monitoring:**

- Transparansi informasi akademik  
- Monitoring perkembangan anak  
- Komunikasi tidak langsung dengan pesantren  

**Akses Read-Only:**

- Semua data bersifat view-only  
- Tidak dapat mengubah atau menghapus data  
- Akses terbatas pada data anak masing-masing  

---

## Flow Kerja Sistem

1. Admin menyiapkan infrastruktur (data guru, kurikulum, jadwal)  
2. Admin/Guru menginput data santri baru  
3. Guru melaksanakan pembelajaran sesuai jadwal dan kurikulum  
4. Guru membuat jurnal evaluasi mingguan  
5. Wali Murid memantau progress melalui sistem  
6. Admin melakukan monitoring dan evaluasi keseluruhan
