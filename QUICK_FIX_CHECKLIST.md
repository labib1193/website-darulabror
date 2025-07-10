# Quick Fix Checklist - Error 500 Dokumen

## Jika Error 500 Muncul Lagi

### 1. **Immediate Checks** ⚡
```bash
# Check if Cloudinary is configured
php artisan cloudinary:verify

# Check recent logs
tail -20 storage/logs/laravel.log
```

### 2. **Environment Variables** 🔧
Pastikan salah satu dari ini ada di `.env`:
```env
# Option A (Recommended)
CLOUDINARY_URL=cloudinary://key:secret@cloudname

# Option B
CLOUDINARY_CLOUD_NAME=yourcloud
CLOUDINARY_KEY=yourkey
CLOUDINARY_SECRET=yoursecret
```

### 3. **Common Error Messages & Solutions** 🩺

| Error Message | Quick Fix |
|---------------|-----------|
| "Cloudinary tidak dikonfigurasi" | Periksa `.env`, restart app |
| "Data user tidak ditemukan" | User dihapus, hapus dokumen terkait |
| "File tidak dapat dimuat" | Check Cloudinary connection |
| "Terjadi kesalahan saat menampilkan" | Check logs, verify database |

### 4. **Emergency Commands** 🚨
```bash
# Restart services
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Check database connectivity  
php artisan migrate:status

# Test Cloudinary
php artisan cloudinary:verify
```

### 5. **Log Analysis** 📊
Look for these patterns in `storage/logs/laravel.log`:
- `Cloudinary upload failed`
- `Dokumen found but user is missing`
- `Error getting file URL`
- `Error displaying dokumen details`

### 6. **Safe Mode Recovery** 🛡️
If all else fails:
1. Comment out Cloudinary validation in controller
2. Add debugging to identify exact error
3. Check database for corrupted records
4. Verify user-dokumen relationships

### 7. **Prevention** 🛡️
- Monitor logs daily
- Regular Cloudinary quota check
- Database backup strategy
- Test upload functionality weekly

## Developer Notes
- All errors are now logged with context
- Graceful fallbacks implemented
- User data validation in middleware
- Safe URL generation with error handling

Last Updated: {{ date('Y-m-d H:i:s') }}
