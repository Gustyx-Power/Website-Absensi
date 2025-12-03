# Sistem Absensi Modern

Sistem absensi berbasis web dengan teknologi TALL Stack (Tailwind CSS, Alpine.js, Laravel 11, Livewire 3). Dirancang untuk memudahkan manajemen kehadiran karyawan dengan fitur check-in/out berbasis GPS dan kamera selfie.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3-purple?style=flat-square)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3-blue?style=flat-square&logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## ✨ Fitur Utama

### 🔐 Autentikasi Google OAuth
- Login aman menggunakan akun Google
- **Role Lock Mechanism**: Email yang sudah terdaftar (Owner/Admin) tetap mempertahankan role-nya
- User baru otomatis mendapat role Employee

### 📱 Absensi Mobile-First (Employee)
- ✅ Check-In & Check-Out dengan foto selfie (front camera)
- 📍 Validasi GPS otomatis (Haversine Formula)
- 🚫 Reject absensi jika jarak > 50 meter dari kantor
- 📊 Riwayat absensi dengan filter bulan
- 📈 Statistik kehadiran (Tepat Waktu, Terlambat)

### 💼 Dashboard Admin (HRD & Owner)
- 📊 **Dashboard dengan ApexCharts**:
  - Line Chart: Tren absensi 7 hari terakhir
  - Pie Chart: Perbandingan Tepat Waktu vs Terlambat
- 👥 **Manajemen Karyawan**:
  - Edit email dan department
  - Admin tidak bisa edit/delete Owner
- 📄 **Laporan Absensi**:
  - Filter: Date range, Karyawan, Department, Status
  - Export to Excel (.xlsx)

### 🎯 Role System
1. **Owner (Dewa)** - Full control, bisa create/delete Admin
2. **Admin (HRD)** - Kelola karyawan, lihat laporan (tidak bisa ubah Owner)
3. **Employee (Karyawan)** - Check-in/out, lihat history sendiri

## 🚀 Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Livewire 3, Alpine.js
- **Styling**: Tailwind CSS (Enterprise Theme)
- **Database**: SQLite (default), support MySQL/PostgreSQL
- **Authentication**: Laravel Socialite (Google OAuth)
- **Charts**: ApexCharts
- **Export**: Maatwebsite Excel

## 📦 Instalasi

### Prasyarat
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite (atau MySQL/PostgreSQL)

### Quick Start

#### Windows
```batch
# Clone repository
git clone <repository-url>
cd wengset-absensi

# Jalankan installer otomatis
install.bat
```

#### Linux/Mac
```bash
# Clone repository
git clone <repository-url>
cd wengset-absensi

# Berikan permission dan jalankan installer
chmod +x install.sh
./install.sh
```

### Manual Installation

```bash
# Install dependencies
composer install
npm install

# Build assets
npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database
touch database/database.sqlite

# Run migrations & seeders
php artisan migrate --seed

# Start server
php artisan serve
```

## ⚙️ Konfigurasi

### 1. Google OAuth Setup

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih yang sudah ada
3. Enable **Google+ API**
4. Buat **OAuth 2.0 Client ID**
5. Tambahkan Authorized Redirect URI: `http://localhost:8000/auth/google/callback`
6. Copy **Client ID** dan **Client Secret**
7. Update `.env`:

```env
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

### 2. Koordinat Kantor

Update koordinat kantor di `.env`:

```env
OFFICE_LATITUDE=-6.200000    # Latitude kantor
OFFICE_LONGITUDE=106.816666  # Longitude kantor
ATTENDANCE_RADIUS=50         # Radius dalam meter
```

**Tips**: Gunakan [Google Maps](https://maps.google.com) → Klik kanan → "Apa yang ada di sini?" untuk mendapatkan koordinat.

## 👤 Akun Default

Sistem sudah di-seed dengan 3 akun:

| Role     | Email                           | Password (Testing) |
|----------|----------------------------------|-------------------|
| Owner    | gustiadityamuzaky08@gmail.com   | password          |
| Admin    | gustiadityacreator07@gmail.com  | password          |
| Employee | fajartergg@gmail.com            | password          |

> **Note**: Password hanya untuk testing manual. Login production harus menggunakan Google OAuth.

## 📱 Cara Penggunaan

### Employee (Karyawan)

1. Buka URL sistem di mobile browser
2. Login dengan Google
3. Halaman Check-In akan muncul
4. Klik "Ambil Foto" → izinkan kamera
5. Izinkan GPS → sistem akan validasi jarak
6. Klik "Check-In Sekarang"

### Admin/HRD

1. Login dengan akun Admin
2. **Dashboard**: Lihat statistik dan grafik
3. **Data Karyawan**: Edit email/department karyawan
4. **Laporan**: Filter dan export Excel

### Owner (Dewa)

Semua akses Admin + kemampuan untuk:
- Create/delete Admin
- Akses settings (koordinat kantor, dll)

## 🛠️ Development

```bash
# Start dev server with hot reload
php artisan serve

# Watch for asset changes
npm run dev

# Run tests
php artisan test

# Code formatting
./vendor/bin/pint
```

## 📄 Lisensi

MIT License - Silakan gunakan untuk proyek komersial maupun pribadi.

## 🤝 Kontribusi

Contributions are welcome! Silakan buat Pull Request atau buka Issue untuk bug report dan feature request.

## 📞 Support

Jika ada pertanyaan atau butuh bantuan, silakan buka Issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan TALL Stack**
