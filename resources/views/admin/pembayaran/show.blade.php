@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pembayaran.index') }}">Data Pembayaran</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pembayaran - {{ $pembayaran->kode_pembayaran }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 30%">Kode Pembayaran</th>
                                        <td>{{ $pembayaran->kode_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pembayaran</th>
                                        <td>{{ $pembayaran->jenis_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nominal</th>
                                        <td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pembayaran</th>
                                        <td>{{ $pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y H:i') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pembayaran</th>
                                        <td>
                                            @if($pembayaran->status_pembayaran == 'lunas')
                                            <span class="badge badge-success">Lunas</span>
                                            @elseif($pembayaran->status_pembayaran == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @elseif($pembayaran->status_pembayaran == 'proses')
                                            <span class="badge badge-info">Proses</span>
                                            @else
                                            <span class="badge badge-danger">Gagal</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            @if($pembayaran->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-download"></i> Download Bukti
                                            </a>
                                            @else
                                            <span class="text-muted">Tidak ada bukti</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Catatan</th>
                                        <td>{{ $pembayaran->catatan ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dibuat</th>
                                        <td>{{ $pembayaran->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diperbarui</th>
                                        <td>{{ $pembayaran->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aksi</h3>
                    </div>
                    <div class="card-body">
                        @if($pembayaran->status_pembayaran == 'pending')
                        <form action="#" method="POST" class="mb-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status_pembayaran" value="lunas">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Konfirmasi Lunas
                            </button>
                        </form>
                        <form action="#" method="POST" class="mb-2">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status_pembayaran" value="gagal">
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-times"></i> Tolak Pembayaran
                            </button>
                        </form>
                        @endif

                        @if($pembayaran->bukti_pembayaran)
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-info btn-block">
                            <i class="fas fa-eye"></i> Lihat Bukti
                        </a>
                        @endif

                        <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}" class="btn btn-warning btn-block">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>

                        <form action="{{ route('admin.pembayaran.destroy', $pembayaran->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini?')">
                                <i class="fas fa-trash"></i> Hapus Data
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Preview Bukti Pembayaran (jika gambar) -->
                @if($pembayaran->bukti_pembayaran && in_array(pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Preview Bukti Pembayaran</h3>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection