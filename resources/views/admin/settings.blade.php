@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengaturan Sistem</h1>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan</li>
                </ol>
            </div> -->
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- Profile Settings -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profil Admin</h3>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" value="{{ ucfirst(auth()->user()->role) }}" readonly>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Profil</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Change Password -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Password</h3>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current_password">Password Saat Ini</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- System Information -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Sistem</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Laravel Version:</strong>
                                <p class="text-muted">{{ app()->version() }}</p>
                            </div>
                            <div class="col-md-3">
                                <strong>PHP Version:</strong>
                                <p class="text-muted">{{ phpversion() }}</p>
                            </div>
                            <div class="col-md-3">
                                <strong>Environment:</strong>
                                <p class="text-muted">{{ config('app.env') }}</p>
                            </div>
                            <div class="col-md-3">
                                <strong>Debug Mode:</strong>
                                <p class="text-muted">{{ config('app.debug') ? 'Aktif' : 'Nonaktif' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection