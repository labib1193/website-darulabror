# Konfigurasi Cloudinary untuk Website Darulabror

## Pendahuluan
Website Darulabror menggunakan Cloudinary untuk menyimpan dan mengelola file dokumen yang diupload oleh user. Dokumen yang disimpan meliputi:
- Foto KTP
- Foto Kartu Keluarga
- Foto Ijazah
- Pas Foto
- Surat Keterangan Sehat

## Cara Mendapatkan Kredensial Cloudinary

1. **Buat Akun Cloudinary**
   - Kunjungi [https://cloudinary.com](https://cloudinary.com)
   - Daftar akun gratis atau login jika sudah punya akun

2. **Dapatkan Kredensial**
   - Setelah login, masuk ke Dashboard
   - Di halaman Dashboard, Anda akan melihat section "Account Details"
   - Catat informasi berikut:
     - **Cloud name**: nama cloud Anda
     - **API Key**: kunci API
     - **API Secret**: secret key (klik "eye" icon untuk melihat)

## Konfigurasi Environment Variables

Tambahkan konfigurasi berikut ke file `.env` Anda:

```env
# Opsi 1: Menggunakan CLOUDINARY_URL (Recommended)
CLOUDINARY_URL=cloudinary://API_Key:API_Secret@Cloud_Name

# Opsi 2: Menggunakan kredensial terpisah
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_KEY=your_api_key
CLOUDINARY_SECRET=your_api_secret

# Opsional
CLOUDINARY_UPLOAD_PRESET=your_upload_preset
CLOUDINARY_NOTIFICATION_URL=your_webhook_url
```

### Contoh Konfigurasi

```env
# Contoh dengan CLOUDINARY_URL
CLOUDINARY_URL=cloudinary://123456789012345:abcdefghijklmnopqrstuvwxyz123456789012345@mycloud

# Atau contoh dengan kredensial terpisah
CLOUDINARY_CLOUD_NAME=mycloud
CLOUDINARY_KEY=123456789012345
CLOUDINARY_SECRET=abcdefghijklmnopqrstuvwxyz123456789012345
```

## Verifikasi Konfigurasi

1. **Cek Konfigurasi**
   Setelah menambahkan environment variables, restart aplikasi Laravel Anda.

2. **Test Upload**
   - Coba upload dokumen melalui halaman admin
   - Jika berhasil, file akan tersimpan di Cloudinary dan URL-nya akan tampil di database

3. **Monitor Logs**
   - Periksa file log Laravel (`storage/logs/laravel.log`) untuk error terkait Cloudinary
   - Error umum biasanya terkait kredensial yang salah atau jaringan

## Troubleshooting

### Error: "Cloudinary tidak dikonfigurasi dengan benar"
- Pastikan environment variables sudah diset dengan benar
- Restart aplikasi setelah mengubah `.env`
- Periksa apakah tidak ada spasi atau karakter khusus di nilai environment variables

### Error: "Failed to initialize Cloudinary client"
- Periksa koneksi internet
- Verifikasi kredensial di dashboard Cloudinary
- Pastikan API Key dan Secret tidak expired

### Error: "Unauthorized"
- Kredensial API Key atau Secret salah
- Periksa kembali di dashboard Cloudinary

### File tidak dapat dimuat
- Periksa URL file di database, pastikan valid
- Periksa pengaturan permissions di Cloudinary
- Pastikan file tidak dihapus dari Cloudinary

## Struktur Penyimpanan di Cloudinary

File akan disimpan dengan struktur:
```
dokumen/
├── foto_ktp_USER_ID_TIMESTAMP
├── foto_kk_USER_ID_TIMESTAMP  
├── foto_ijazah_USER_ID_TIMESTAMP
├── pas_foto_USER_ID_TIMESTAMP
└── surat_sehat_USER_ID_TIMESTAMP
```

## Fitur Keamanan

1. **Error Handling**: Aplikasi menangani error dengan graceful fallback
2. **Logging**: Semua error Cloudinary dicatat dalam log Laravel
3. **Validation**: File divalidasi sebelum upload (tipe, ukuran)
4. **Safe URLs**: URL file dikontrol dan divalidasi sebelum ditampilkan

## Maintenance

1. **Monitor Usage**: Periksa usage quota di dashboard Cloudinary
2. **Backup**: Cloudinary menyediakan backup otomatis
3. **Cleanup**: File lama akan dihapus otomatis saat user mengganti dokumen

## Support

Jika mengalami masalah:
1. Periksa log Laravel untuk detail error
2. Verifikasi konfigurasi environment variables
3. Hubungi administrator sistem
