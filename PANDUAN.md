# Panduan Lengkap Sistem Absensi Modern

Dokumen ini berisi panduan lengkap penggunaan sistem absensi untuk semua role pengguna.

## 📑 Daftar Isi

1. [Panduan untuk Employee (Karyawan)](#panduan-employee)
2. [Panduan untuk Admin (HRD)](#panduan-admin)
3. [Panduan untuk Owner (Dewa)](#panduan-owner)
4. [FAQ & Troubleshooting](#faq)

---

## 👤 Panduan Employee (Karyawan) <a name="panduan-employee"></a>

### Login Pertama Kali

1. Buka URL sistem (contoh: `https://absensi.perusahaan.com`)
2. Klik tombol **"Login dengan Google"**
3. Pilih akun Google Anda
4. Jika email Anda sudah terdaftar, Anda akan langsung masuk
5. Jika email baru, sistem otomatis membuat akun Employee untuk Anda

### Check-In (Absen Masuk)

1. Setelah login, Anda akan langsung di halaman **Check-In**
2. Pastikan GPS sudah aktif di HP Anda
3. Izinkan browser mengakses lokasi Anda
4. Klik **"Ambil Foto"** atau ikon kamera
5. Izinkan browser mengakses kamera (akan otomatis buka kamera depan)
6. Ambil foto selfie Anda
7. Tunggu sistem mendeteksi GPS Anda (akan muncul "✓ Lokasi terdeteksi")
8. Klik tombol **"🚀 Check-In Sekarang"**

**Hasil yang mungkin terjadi:**
- ✅ **Berhasil**: "Check-in berhasil! Jarak: 25.5 m"
- ❌ **Gagal - Terlalu jauh**: "Anda terlalu jauh dari kantor! Jarak Anda: 150 m"
- ❌ **Gagal - GPS tidak aktif**: "Lokasi GPS tidak terdeteksi"
- ❌ **Gagal - Sudah check-in**: "Anda sudah melakukan check-in hari ini!"

### Check-Out (Absen Pulang)

1. Kembali ke halaman Check-In (navigasi bawah → ikon jam)
2. Sistem otomatis mendeteksi Anda sudah check-in
3. Tombol berubah jadi **"🏁 Check-Out Sekarang"**
4. Prosesnya sama seperti check-in (foto + GPS)

### Lihat Riwayat Absensi

1. Klik ikon **"Riwayat"** di navigasi bawah
2. Anda akan lihat 3 kartu statistik:
   - **Total**: Jumlah check-in bulan ini
   - **Tepat Waktu**: Berapa kali on-time
   - **Terlambat**: Berapa kali terlambat
3. Scroll ke bawah untuk lihat list absensi
4. Gunakan **Filter Bulan** untuk lihat bulan lain
5. Setiap card menampilkan:
   - Tanggal dan jam
   - Status (badge hijau/merah)
   - Jarak dari kantor

### Lihat Profil

1. Klik ikon **"Profil"** di navigasi bawah
2. Anda bisa lihat:
   - Foto profil (dari Google)
   - Nama (dari Google)
   - Email
   - Department

> **⚠️ Catatan Penting**: Nama dan foto tidak bisa diubah manual karena disinkronkan otomatis dari Google. Jika perlu ubah email, hubungi Admin/HRD.

---

## 👔 Panduan Admin (HRD) <a name="panduan-admin"></a>

### Akses Dashboard

1. Login dengan akun Admin (`gustiadityacreator07@gmail.com`)
2. Anda akan langsung diarahkan ke **Dashboard Admin**
3. Dashboard menampilkan:
   - **Card Statistik**: Total Karyawan, Absen Hari Ini, Terlambat Hari Ini, Tepat Waktu Bulan Ini
   - **Grafik Tren**: Line chart absensi 7 hari terakhir
   - **Grafik Pie**: Perbandingan tepat waktu vs terlambat bulan ini
   - **Tabel Absensi Terbaru**: 10 absensi terakhir

### Kelola Data Karyawan

1. Klik menu **"Data Karyawan"** di sidebar
2. Gunakan **Search** untuk cari karyawan (berdasarkan nama/email)
3. Gunakan **Filter Department** untuk filter berdasarkan department

**Edit Karyawan:**
1. Klik tombol **"Edit"** pada row karyawan
2. Modal edit akan muncul
3. Anda bisa ubah:
   - **Email** (jika karyawan kehilangan akses Google)
   - **Department** (Engineering, Marketing, dll)
4. **Nama tidak bisa diedit** (sync otomatis dari Google)
5. Klik **"Simpan Perubahan"**

**Batasan Admin:**
- ❌ Admin **TIDAK BISA** edit atau delete Owner
- ❌ Admin **TIDAK BISA** create Admin baru (hanya Owner yang bisa)

### Lihat dan Export Laporan

1. Klik menu **"Laporan Absensi"** di sidebar
2. Filter data menggunakan:
   - **Tanggal Mulai & Akhir**: Range tanggal (default: bulan ini)
   - **Karyawan**: Pilih karyawan tertentu atau semua
   - **Department**: Filter berdasarkan department
   - **Status**: Tepat Waktu, Terlambat, atau Pulang Cepat
3. Tabel akan update otomatis sesuai filter

**Export ke Excel:**
1. Set filter yang Anda inginkan
2. Klik tombol **"Export Excel"** (hijau, pojok kanan atas)
3. File `.xlsx` akan terdownload otomatis
4. Nama file: `attendance-report-2024-01-01-to-2024-01-31.xlsx`
5. Isi file:
   - Tanggal, Nama, Email, Department
   - Tipe (Check-In/Check-Out), Waktu, Status
   - Jarak, Koordinat GPS

---

## 👑 Panduan Owner (Dewa) <a name="panduan-owner"></a>

Owner memiliki **semua akses Admin** + kemampuan additional:

### Kelola Admin

**Create Admin Baru:**
1. Minta calon Admin untuk login via Google dulu (akan jadi Employee)
2. Masuk ke menu **Settings** (owner only)
3. Cari user berdasarkan email
4. Ubah role dari `employee` menjadi `admin`

**Delete Admin:**
1. Masuk ke menu **Settings**
2. Cari Admin yang ingin dihapus
3. Klik **Delete** (hanya Owner yang bisa)

### Update Settings Sistem

1. Klik menu **"Settings"** di sidebar (hanya Owner yang lihat)
2. Anda bisa update:
   - **Koordinat Kantor** (Latitude & Longitude)
   - **Radius Absensi** (default: 50 meter)
   - **Jam Kerja** (Mulai & Selesai)
   - **Toleransi Keterlambatan** (dalam menit)
   - **Nama Perusahaan**
   - **Alamat Perusahaan**
3. Klik **"Simpan Settings"**

**Cara mendapatkan koordinat kantor:**
1. Buka [Google Maps](https://maps.google.com)
2. Cari lokasi kantor Anda
3. Klik kanan pada pin lokasi
4. Klik **"Apa yang ada di sini?"**
5. Copy koordinat (format: `-6.200000, 106.816666`)
6. Latitude: angka pertama
7. Longitude: angka kedua

---

## ❓ FAQ & Troubleshooting <a name="faq"></a>

### ❓ "GPS tidak terdeteksi" - Apa yang harus dilakukan?

**Untuk Android:**
1. Buka **Settings** → **Lokasi**
2. Aktifkan **"Gunakan GPS, Wi-Fi, dan jaringan seluler"** (mode High Accuracy)
3. Buka browser (Chrome)
4. Ketuk ikon kunci/info di address bar
5. Izinkan **"Lokasi"**
6. Refresh halaman absensi

**Untuk iOS:**
1. Buka **Settings** → **Privacy** → **Location Services**
2. Pastikan Safari **ON** dan set ke **"While Using the App"**
3. Refresh halaman absensi

### ❓ "Kamera tidak muncul" - Bagaimana solusinya?

**Untuk Android:**
1. Buka **Settings** → **Apps** → **Chrome** → **Permissions**
2. Izinkan **Camera**
3. Refresh halaman

**Untuk iOS:**
1. Buka **Settings** → **Safari** → **Camera**
2. Set ke **"Ask"** atau **"Allow"**
3. Refresh halaman

### ❓ Saya terlalu jauh dari kantor, tapi butuh absen - Gimana?

**Solusi:**
1. Hubungi Admin/Owner
2. Minta Owner untuk sementara naikkan **Radius Absensi** di Settings
3. Absen selama radius masih besar
4. Owner kembalikan radius ke semula

### ❓ Lupa check-out kemarin, bisa gak input manual?

**Tidak bisa dari aplikasi.** Hubungi Admin untuk:
1. Check database secara manual
2. Insert data check-out manual (via phpMyAdmin atau tool DB)

**Alternatif (Owner):**
1. Buat fitur "Edit Attendance" untuk Admin
2. Admin bisa edit/tambah data manual (fitur tambahan, belum ada di sistem ini)

### ❓ Email saya berubah, tapi sistem masih pakai email lama?

**Untuk Employee:**
1. Hubungi Admin/HRD
2. Admin bisa edit email Anda di menu **"Data Karyawan"**

**Untuk Admin/Owner:**
1. Hanya Owner yang bisa edit email Admin
2. Hubungi Owner untuk update

### ❓ Foto selfie saya jelek, bisa diulang?

**Tidak bisa.** Foto sudah otomatis tersimpan setelah submit. Sistem ini dirancang untuk **anti-manipulasi** (tidak bisa upload foto dari galeri).

**Tip**: Ambil foto di tempat yang cukup cahaya.

### ❓ Sistem menolak absen padahal saya di kantor?

**Kemungkinan masalah:**
1. **GPS tidak akurat**: Tunggu 10-20 detik, biarkan GPS stabilize
2. **Radius terlalu kecil**: Minta Owner naikkan radius (50m → 100m)
3. **Koordinat kantor salah**: Cek dengan Owner apakah koordinat sudah benar

**Test koordinat:**
1. Copy koordinat dari sistem
2. Paste ke Google Maps: `https://www.google.com/maps?q=LAT,LONG`
3. Lihat apakah pin muncul di lokasi kantor yang benar

### ❓ Bagaimana jika HP mati/hilang, karyawan tidak bisa absen?

**Solusi Darurat:**
1. Karyawan pinjam HP teman
2. Login dengan Google (email sendiri)
3. Absen seperti biasa

**Solusi Permanen:**
Beli HP baru, login dengan Google yang sama, sistem otomatis sync.

### ❓ Saya Owner tapi tidak bisa login? (Email tidak terdaftar)

**Kemungkinan:**
1. Email typo saat seeding
2. Database belum di-seed

**Solusi:**
```bash
# Re-run seeder
php artisan migrate:fresh --seed
```

Atau update manual via database.

---

## 📞 Kontak Support

Jika masalah belum resolved:
1. Cek log error: `storage/logs/laravel.log`
2. Buka Issue di repository GitHub
3. Hubungi developer sistem

---

**Sistem Absensi Modern v1.0**  
© 2024 Wengset Technology
