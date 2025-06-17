@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Data User</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
                        <h3 class="card-title">Form Tambah User</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        <small class="form-text text-muted">Minimal 8 karakter</small>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control"
                                            id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-control @error('role') is-invalid @enderror"
                                            id="role" name="role" required>
                                            <option value="">Pilih Role</option>
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_photo">Foto Profil</label>
                                        <input type="file" class="form-control-file @error('profile_photo') is-invalid @enderror"
                                            id="profile_photo" name="profile_photo" accept=".jpg,.jpeg,.png">
                                        <small class="form-text text-muted">
                                            Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.
                                        </small>
                                        @error('profile_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1" {{ old('email_verified') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="email_verified">
                                                Email sudah terverifikasi
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Preview area for uploaded image -->
                                    <div id="image-preview" style="display: none;" class="form-group">
                                        <label>Preview Foto Profil</label>
                                        <div class="text-center">
                                            <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info"></i> Informasi Role:</h5>
                                        <ul class="mb-0">
                                            <li><strong>User:</strong> Pengguna biasa dengan akses terbatas</li>
                                            <li><strong>Admin:</strong> Administrator dengan akses pengelolaan data</li>
                                            <li><strong>Super Admin:</strong> Administrator tertinggi dengan akses penuh</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan User
                            </button>
                            <button type="reset" class="btn btn-warning">
                                <i class="fas fa-undo"></i> Reset
                            </button>
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

        if (password !== confirmation) {
            e.target.setCustomValidity('Password tidak cocok');
        } else {
            e.target.setCustomValidity('');
        }
    });

    // Auto-generate email from name (optional)
    document.getElementById('name').addEventListener('blur', function(e) {
        const emailField = document.getElementById('email');
        if (!emailField.value) {
            const name = e.target.value.toLowerCase().replace(/\s+/g, '.');
            if (name) {
                emailField.value = name + '@example.com';
            }
        }
    });
</script>
@endpush
@endsection