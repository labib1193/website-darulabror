@extends('layouts.user')

@section('title', 'Pengaturan Akun - Dashboard Santri')
@section('page-title', 'Pengaturan Akun')

@section('content')
<div class="row">
    <!-- Ubah Profil -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Profil</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::check() && Auth::user() ? Auth::user()->name : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::check() && Auth::user() ? Auth::user()->email : '' }}">
                        <small class="form-text text-muted">Email digunakan untuk login</small>
                    </div>

                    <div class="form-group">
                        <label for="telepon">No. Telepon</label>
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="08xxxxxxxxxx">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Ubah Password -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama">
                    </div>

                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru">
                        <small class="form-text text-muted">Minimal 6 karakter</small>
                    </div>

                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                    </div>

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Upload Foto Profil -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Foto Profil</h3>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" alt="Foto Profil" class="img-circle" style="width: 120px; height: 120px;">
                </div>

                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto_profil" name="foto_profil" accept="image/*">
                                <label class="custom-file-label" for="foto_profil">Pilih foto...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG. Maksimal 1MB</small>
                    </div>

                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Informasi Akun -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Akun</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Status Akun:</strong></td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Daftar:</strong></td>
                        <td>{{ Auth::check() && Auth::user() && Auth::user()->created_at ? Auth::user()->created_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Login Terakhir:</strong></td>
                        <td>{{ Auth::check() && Auth::user() && Auth::user()->updated_at ? Auth::user()->updated_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Verified:</strong></td>
                        <td>
                            @if(Auth::check() && Auth::user() && Auth::user()->email_verified_at)
                            <span class="badge badge-success">Terverifikasi</span>
                            @else
                            <span class="badge badge-warning">Belum Terverifikasi</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="#" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Hapus Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update label saat file dipilih
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Preview foto profil
        $('#foto_profil').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-circle').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush