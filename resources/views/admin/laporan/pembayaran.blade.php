@extends('layouts.admin')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Laporan Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Pembayaran</li>
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
                        <form method="GET" action="{{ route('admin.laporan.pembayaran') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tanggal_dari">Tanggal Dari</label>
                                        <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari"
                                            value="{{ request('tanggal_dari') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tanggal_sampai">Tanggal Sampai</label>
                                        <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
                                            value="{{ request('tanggal_sampai') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Status Pembayaran</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Pembayaran</label>
                                        <select class="form-control" id="jenis" name="jenis">
                                            <option value="">Semua Jenis</option>
                                            <option value="Pendaftaran" {{ request('jenis') == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                            <option value="SPP" {{ request('jenis') == 'SPP' ? 'selected' : '' }}>SPP</option>
                                            <option value="Seragam" {{ request('jenis') == 'Seragam' ? 'selected' : '' }}>Seragam</option>
                                            <option value="Buku" {{ request('jenis') == 'Buku' ? 'selected' : '' }}>Buku</option>
                                            <option value="Kegiatan" {{ request('jenis') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                            <option value="Lainnya" {{ request('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="metode">Metode Pembayaran</label>
                                        <select class="form-control" id="metode" name="metode">
                                            <option value="">Semua Metode</option>
                                            <option value="Cash" {{ request('metode') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="Transfer Bank" {{ request('metode') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                            <option value="E-Wallet" {{ request('metode') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="QRIS" {{ request('metode') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <a href="{{ route('admin.laporan.pembayaran') }}" class="btn btn-secondary btn-block">
                                                <i class="fas fa-undo"></i> Reset
                                            </a>
                                            <button type="button" class="btn btn-success btn-block" onclick="exportLaporan()">
                                                <i class="fas fa-download"></i> Export
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
                        <p>Total Transaksi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp {{ number_format($statistik['total_lunas'] ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Lunas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Rp {{ number_format($statistik['total_pending'] ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $statistik['total_gagal'] ?? 0 }}</h3>
                        <p>Transaksi Gagal</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trend Pembayaran (30 Hari Terakhir)</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="trendChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Status Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jenis Pembayaran Chart -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jenis Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="jenisChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Metode Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="metodeChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pembayaran</h3>
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
                                    <th>Kode Pembayaran</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayaran ?? collect() as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->kode_pembayaran }}</td>
                                    <td>{{ $p->jenis_pembayaran }}</td>
                                    <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $p->metode_pembayaran }}</td>
                                    <td>
                                        @if($p->status_pembayaran == 'lunas')
                                        <span class="badge badge-success">Lunas</span>
                                        @elseif($p->status_pembayaran == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($p->status_pembayaran == 'proses')
                                        <span class="badge badge-info">Proses</span>
                                        @else
                                        <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->tanggal_pembayaran ? \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('d/m/Y H:i') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.pembayaran.show', $p->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pembayaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <th colspan="3">Total</th>
                                    <th>Rp {{ number_format($totalNominal ?? 0, 0, ',', '.') }}</th>
                                    <th colspan="4"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if(isset($pembayaran) && $pembayaran->hasPages())
                    <div class="card-footer clearfix">
                        {{ $pembayaran->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<!-- Chart.js -->
<!-- Hidden data elements for JavaScript -->
<div id="chart-data" style="display: none;">
    <span id="trend-labels">@json($trendLabels ?? [])</span>
    <span id="trend-count">@json($trendCount ?? [])</span>
    <span id="trend-amount">@json($trendAmount ?? [])</span>
    <span id="status-data">@json([
        $statistik['count_lunas'] ?? 0,
        $statistik['count_pending'] ?? 0,
        $statistik['count_proses'] ?? 0,
        $statistik['count_gagal'] ?? 0
        ])</span>
    <span id="jenis-labels">@json($jenisLabels ?? [])</span>
    <span id="jenis-data">@json($jenisData ?? [])</span>
    <span id="metode-labels">@json($metodeLabels ?? [])</span>
    <span id="metode-data">@json($metodeData ?? [])</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get data from hidden elements
    const trendLabels = JSON.parse(document.getElementById('trend-labels').textContent);
    const trendCount = JSON.parse(document.getElementById('trend-count').textContent);
    const trendAmount = JSON.parse(document.getElementById('trend-amount').textContent);
    const statusData = JSON.parse(document.getElementById('status-data').textContent);
    const jenisLabels = JSON.parse(document.getElementById('jenis-labels').textContent);
    const jenisData = JSON.parse(document.getElementById('jenis-data').textContent);
    const metodeLabels = JSON.parse(document.getElementById('metode-labels').textContent);
    const metodeData = JSON.parse(document.getElementById('metode-data').textContent);

    // Trend Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: trendCount,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                yAxisID: 'y'
            }, {
                label: 'Total Nominal (Ribuan)',
                data: trendAmount,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            }
        }
    }); // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Pending', 'Proses', 'Gagal'],
            datasets: [{
                data: statusData,
                backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Jenis Pembayaran Chart
    const jenisCtx = document.getElementById('jenisChart').getContext('2d');
    const jenisChart = new Chart(jenisCtx, {
        type: 'bar',
        data: {
            labels: jenisLabels,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: jenisData,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14']
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

    // Metode Pembayaran Chart
    const metodeCtx = document.getElementById('metodeChart').getContext('2d');
    const metodeChart = new Chart(metodeCtx, {
        type: 'pie',
        data: {
            labels: metodeLabels,
            datasets: [{
                data: metodeData,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Export function
    function exportLaporan() {
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'excel');
        window.location.href = '{{ route("admin.laporan.pembayaran") }}?' + params.toString();
    }
</script>
@endpush
@endsection