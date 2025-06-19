# Perbaikan Form Edit Identitas Admin

## Deskripsi
Perbaikan form edit identitas di dashboard admin agar konsisten dengan detail view dan form user.

## Perubahan yang Dilakukan

### 1. Restructurasi Form Edit Admin
- **File**: `resources/views/admin/identitas/edit.blade.php`
- **Perubahan**:
  - Mengorganisir field menjadi 2 kolom dengan heading yang jelas:
    - **Data Pribadi**: NIK, No. KK, Tempat Lahir, Tanggal Lahir, Usia, Jenis Kelamin, No. HP
    - **Data Alamat**: Alamat Lengkap, Desa/Kelurahan, Kecamatan, Kabupaten/Kota, Provinsi, Kode Pos, Pekerjaan
    - **Status Verifikasi**: Status verifikasi dalam section terpisah

### 2. Field yang Dihapus
- **Agama** - Dihapus karena tidak digunakan lagi
- **RT/RW** - Dihapus karena tidak digunakan lagi
- **Email** - Dihapus karena sudah ada di data user
- **No. Telepon** - Diganti dengan No. HP untuk konsistensi

### 3. Field yang Ditambah/Diperbaiki
- **No. KK** - Ditambahkan untuk kelengkapan data
- **Usia** - Ditambahkan dengan validasi 1-100 tahun
- **Pekerjaan** - Ditambahkan sesuai kebutuhan
- **Alamat Lengkap** - Mengganti "Alamat" dengan menggunakan kolom `alamat_lengkap`
- **Desa/Kelurahan** - Dibuat required sesuai form user

### 4. Update Controller Admin
- **File**: `app/Http/Controllers/Admin/IdentitasController.php`
- **Method**: `update()`
- **Perubahan**:
  - Menambah validasi untuk field `usia` (1-100)
  - Menambah validasi untuk `status_verifikasi`
  - Implementasi auto-tracking untuk status verifikasi
  - Update `verified_at` dan `verified_by` ketika status berubah ke terverifikasi

### 5. Validasi yang Diperbaiki
```php
'usia' => 'nullable|integer|min:1|max:100',
'status_verifikasi' => 'nullable|in:pending,terverifikasi,ditolak',
'desa' => 'required|string|max:100', // Dibuat required
```

## Konsistensi yang Dicapai

### Field Order (Urutan Field)
1. **Data Pribadi**:
   - NIK
   - No. KK
   - Tempat Lahir
   - Tanggal Lahir
   - Usia
   - Jenis Kelamin
   - No. HP

2. **Data Alamat**:
   - Alamat Lengkap
   - Desa/Kelurahan
   - Kecamatan
   - Kabupaten/Kota
   - Provinsi
   - Kode Pos
   - Pekerjaan

### Required Fields
- NIK, Tempat Lahir, Tanggal Lahir, Jenis Kelamin, No. HP
- Alamat Lengkap, Desa, Kecamatan, Kabupaten, Provinsi

### Optional Fields  
- No. KK, Usia, Kode Pos, Pekerjaan, Status Verifikasi

## Status
✅ **SELESAI** - Form edit identitas admin sudah 100% konsisten dengan:
- Detail view identitas admin
- Form identitas user
- Validasi yang seragam
- Label dan urutan field yang sama

## Testing
Setelah perubahan:
1. ✅ View cache cleared
2. ✅ Form structure reorganized
3. ✅ Controller validation updated
4. ✅ Field consistency achieved

## Next Steps
- Testing fungsionalitas edit data
- Validasi bahwa semua field tersimpan dengan benar
- Pastikan auto-tracking status verifikasi berfungsi
