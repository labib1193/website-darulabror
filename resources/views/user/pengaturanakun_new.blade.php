@extends('layouts.user')

@section('title', 'Pengaturan Akun - Dashboard Santri')
@section('page-title', 'Pengaturan Akun')

@section('content')
<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <!-- Ubah Profil -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Profil</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.pengaturanakun.profile') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        <small class="form-text text-muted">Email digunakan untuk login</small>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp_1">No. Telepon</label>
                        <input type="tel" class="form-control @error('no_hp_1') is-invalid @enderror"
                            id="no_hp_1" name="no_hp_1" value="{{ old('no_hp_1', $identitas->no_hp_1 ?? '') }}"
                            placeholder="08xxxxxxxxxx">
                        @error('no_hp_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                <form action="{{ route('user.pengaturanakun.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password" name="current_password" required>
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        <small class="form-text text-muted">Minimal 8 karakter</small>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" required>
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
                    @if($user->getProfilePhotoUrl())
                    <img src="{{ $user->getProfilePhotoUrl() }}" alt="Foto Profil" class="img-circle"
                        style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                    <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" alt="Foto Profil" class="img-circle"
                        style="width: 120px; height: 120px;">
                    @endif
                </div>

                @if($user->profile_photo)
                <div class="mb-2">
                    <small class="text-muted">
                        Upload: {{ $user->profile_photo_uploaded_at ? $user->profile_photo_uploaded_at->format('d/m/Y H:i') : '-' }}
                        @if($user->getProfilePhotoSize())
                        | Ukuran: {{ $user->getProfilePhotoSize() }}
                        @endif
                    </small>
                </div>
                @endif

                <form action="{{ route('user.pengaturanakun.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror"
                                    id="profile_photo" name="profile_photo" accept="image/*" required>
                                <label class="custom-file-label" for="profile_photo">Pilih foto...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        @error('profile_photo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Login Terakhir:</strong></td>
                        <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Verified:</strong></td>
                        <td>
                            @if($user->email_verified_at)
                            <span class="badge badge-success">Terverifikasi</span>
                            @else
                            <span class="badge badge-warning">Belum Terverifikasi</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-3">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAccountModal">
                        <i class="fas fa-trash"></i> Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Akun -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Konfirmasi Hapus Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.pengaturanakun.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
                    </div>

                    <div class="form-group">
                        <label for="delete_password">Masukkan password Anda untuk konfirmasi:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="delete_password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Akun
                    </button>
                </div>
            </form>
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
        $('#profile_photo').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-circle').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Auto hide alerts after 5 seconds
        $('.alert').delay(5000).fadeOut();
    });
</script>
@endpush