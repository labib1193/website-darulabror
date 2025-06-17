@extends('layouts.admin')

@section('title', 'Laporan Pendaftar')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Pendaftar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Pendaftar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filter Laporan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.laporan.pendaftar') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tanggal_dari">Tanggal Dari</label>
                                        <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari"
                                            value="{{ request('tanggal_dari') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tanggal_sampai">Tanggal Sampai</label>
                                        <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
                                            value="{{ request('tanggal_sampai') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status Verifikasi</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <a href="{{ route('admin.laporan.pendaftar') }}" class="btn btn-secondary">
                                                <i class="fas fa-undo"></i> Reset
                                            </a>
                                            <button type="button" class="btn btn-success" onclick="exportLaporan()">
                                                <i class="fas fa-download"></i> Export Excel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $statistik['total'] ?? 0 }}</h3>
                        <p>Total Pendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $statistik['terverifikasi'] ?? 0 }}</h3>
                        <p>Terverifikasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $statistik['pending'] ?? 0 }}</h3>
                        <p>Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $statistik['ditolak'] ?? 0 }}</h3>
                        <p>Ditolak</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Status Verifikasi</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trend Pendaftaran (7 Hari Terakhir)</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="trendChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pendaftar</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Status</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftar ?? collect() as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nama_lengkap }}</td>
                                    <td>{{ $p->nik }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->no_telepon }}</td>
                                    <td>
                                        @if($p->status_verifikasi == 'terverifikasi')
                                        <span class="badge badge-success">Terverifikasi</span>
                                        @elseif($p->status_verifikasi == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @else
                                        <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.identitas.show', $p->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pendaftar</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(isset($pendaftar) && $pendaftar->hasPages())
                    <div class="card-footer clearfix">
                        {{ $pendaftar->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hidden data elements for JavaScript -->
<div id="chartData" style="display: none;">
    <div id="statistikData">{{ json_encode($statistik ?? ['terverifikasi' => 0, 'pending' => 0, 'ditolak' => 0]) }}</div>
    <div id="trendLabelsData">{{ json_encode($trendLabels ?? []) }}</div>
    <div id="trendDataData">{{ json_encode($trendData ?? []) }}</div>
    <div id="exportUrl">{{ route("admin.laporan.pendaftar") }}</div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Parse data from hidden elements
    const statistik = JSON.parse(document.getElementById('statistikData').textContent);
    const trendLabels = JSON.parse(document.getElementById('trendLabelsData').textContent);
    const trendData = JSON.parse(document.getElementById('trendDataData').textContent);
    const exportUrl = document.getElementById('exportUrl').textContent;

    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Terverifikasi', 'Pending', 'Ditolak'],
            datasets: [{
                data: [
                    statistik.terverifikasi || 0,
                    statistik.pending || 0,
                    statistik.ditolak || 0
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Trend Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Pendaftar',
                data: trendData,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Export function
    function exportLaporan() {
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'excel');
        window.location.href = exportUrl + '?' + params.toString();
    }
</script>
@endpush
@endsection