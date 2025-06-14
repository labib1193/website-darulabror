@extends('layouts.user')

@section('title', 'Identitas Diri - Dashboard Santri')
@section('page-title', 'Identitas Diri')

@section('breadcrumb')
<li class="breadcrumb-item active">Identitas Diri</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Identitas Diri</h3>
            </div>
            <div class="card-body">
                <p>Silakan lengkapi data identitas diri Anda di bawah ini.</p>

                <!-- Form identitas akan ditambahkan di sini -->
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ Auth::check() && Auth::user() ? Auth::user()->name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::check() && Auth::user() ? Auth::user()->email : '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection