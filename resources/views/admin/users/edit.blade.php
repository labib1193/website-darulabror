@extends('layouts.admin')

@section('title', 'Edit User - ')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Data User</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit User - {{ $user->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password Baru</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password. Minimal 6 karakter.</small>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control"
                                            id="password_confirmation" name="password_confirmation">
                                        <small class="form-text text-muted">Hanya wajib diisi jika mengisi password baru.</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-control @error('role') is-invalid @enderror"
                                            id="role" name="role" required>
                                            <option value="">Pilih Role</option>
                                            @foreach($availableRoles as $role)
                                            <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                                @if($role == 'user')
                                                User
                                                @elseif($role == 'admin')
                                                Admin
                                                @elseif($role == 'superadmin')
                                                Super Admin
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="active" {{ old('status', $user->status ?? 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                                            <option value="inactive" {{ old('status', $user->status ?? 'active') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1"
                                                {{ old('email_verified', $user->email_verified_at ? '1' : '0') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="email_verified">
                                                Email sudah terverifikasi
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_photo">Foto Profil</label>
                                        <input type="file" class="form-control-file @error('profile_photo') is-invalid @enderror"
                                            id="profile_photo" name="profile_photo" accept=".jpg,.jpeg,.png">
                                        <small class="form-text text-muted">
                                            Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.
                                        </small>
                                        @if($user->profile_photo)
                                        <div class="mt-2">
                                            <small class="text-info">Foto saat ini:
                                                <a href="{{ asset('storage/' . $user->profile_photo) }}" target="_blank">
                                                    Lihat foto
                                                </a>
                                            </small>
                                        </div>
                                        @endif
                                        @error('profile_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> <!-- Preview foto profil lama jika ada -->
                                    @if($user->profile_photo)
                                    <div class="form-group">
                                        <label>Foto Profil Saat Ini</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Preview area for uploaded image -->
                                    <div id="image-preview" style="display: none;" class="form-group">
                                        <label>Preview Foto Baru</label>
                                        <div class="text-center">
                                            <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="fas fa-calendar"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Terdaftar</span>
                                                    <span class="info-box-number">{{ $user->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="fas fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Email</span>
                                                    <span class="info-box-number">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Role</span>
                                                    <span class="info-box-number">{{ ucfirst($user->role) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info"></i> Informasi Role:</h5>
                                        <ul class="mb-0">
                                            @if(in_array('user', $availableRoles))
                                            <li><strong>User:</strong> Pengguna biasa dengan akses terbatas</li>
                                            @endif
                                            @if(in_array('admin', $availableRoles))
                                            <li><strong>Admin:</strong> Administrator dengan akses pengelolaan data</li>
                                            @endif
                                            @if(in_array('superadmin', $availableRoles))
                                            <li><strong>Super Admin:</strong> Administrator tertinggi dengan akses penuh</li>
                                            @endif
                                            @if(Auth::user()->role !== 'superadmin')
                                            <li><em>Catatan: Sebagai Admin, Anda hanya dapat mengedit User biasa.</em></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update User
                            </button>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Preview gambar sebelum upload
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').style.display = 'none';
        }
    });

    // Validate password confirmation
    document.getElementById('password_confirmation').addEventListener('input', function(e) {
        const password = document.getElementById('password').value;
        const confirmation = e.target.value;

        if (password && confirmation && password !== confirmation) {
            e.target.setCustomValidity('Password tidak cocok');
        } else {
            e.target.setCustomValidity('');
        }
    });

    // Warning when changing role
    document.getElementById('role').addEventListener('change', function(e) {
        const currentRole = '{{ $user->role }}';
        const newRole = e.target.value;

        if (currentRole !== newRole && (currentRole === 'superadmin' || newRole === 'superadmin')) {
            if (!confirm('Anda akan mengubah role Super Admin. Apakah Anda yakin?')) {
                e.target.value = currentRole;
            }
        }
    });
</script>
@endpush
@endsection