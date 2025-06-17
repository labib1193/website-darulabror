@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
<!-- Add any custom CSS for dashboard -->
@endpush

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalPendaftar ?? 0 }}</h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalPembayaranLunas ?? 0 }}</h3>
                <p>Pembayaran Lunas</p>
            </div>
            <div class="icon">
                <i class="ion ion-checkmark"></i>
            </div>
            <a href="{{ route('admin.pembayaran.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalPembayaranPending ?? 0 }}</h3>
                <p>Pembayaran Pending</p>
            </div>
            <div class="icon">
                <i class="ion ion-clock"></i>
            </div>
            <a href="{{ route('admin.pembayaran.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalDokumenBelumLengkap ?? 0 }}</h3>
                <p>Dokumen Belum Lengkap</p>
            </div>
            <div class="icon">
                <i class="ion ion-document-text"></i>
            </div>
            <a href="{{ route('admin.dokumen.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Chart -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Grafik Pendaftar Bulanan
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock mr-1"></i>
                    Aktivitas Terbaru
                </h3>
            </div>
            <div class="card-body">
                <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-danger">
                            {{ date('d M Y') }}
                        </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-info"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 2 jam lalu</span>
                            <h3 class="timeline-header"><a href="#">Ahmad Rizki</a> melakukan pendaftaran</h3>
                            <div class="timeline-body">
                                Calon santri baru telah mendaftar dan mengisi data identitas.
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-money-bill-wave bg-success"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 5 jam lalu</span>
                            <h3 class="timeline-header"><a href="#">Siti Fatimah</a> melakukan pembayaran</h3>
                            <div class="timeline-body">
                                Pembayaran biaya pendaftaran sebesar Rp 500.000 telah dikonfirmasi.
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-file bg-warning"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 1 hari lalu</span>
                            <h3 class="timeline-header"><a href="#">Muhammad Ali</a> mengupload dokumen</h3>
                            <div class="timeline-body">
                                Dokumen KTP dan KK telah diupload dan menunggu verifikasi.
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.Left col -->

    <!-- Right col (fixed) -->
    <section class="col-lg-5 connectedSortable">
        <!-- Calendar -->
        <div class="card bg-gradient-success">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-user-plus"></i> Tambah User
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-success btn-block">
                            <i class="fas fa-money-check-alt"></i> Cek Pembayaran
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-file-alt"></i> Verifikasi Dokumen
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.laporan.pendaftar') }}" class="btn btn-info btn-block">
                            <i class="fas fa-chart-bar"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

        <!-- Recent Users -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pendaftar Terbaru</h3>
                <div class="card-tools">
                    <span class="badge badge-danger">{{ $recentUsers->count() ?? 0 }} Baru</span>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                    @forelse($recentUsers ?? [] as $user)
                    <li>
                        <img src="{{ $user->profile_photo_url ?? asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="User Image">
                        <a class="users-list-name" href="#">{{ $user->name }}</a>
                        <span class="users-list-date">{{ $user->created_at->format('d M') }}</span>
                    </li>
                    @empty
                    <li class="text-center py-3">
                        <span class="text-muted">Belum ada pendaftar baru</span>
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('admin.users.index') }}">Lihat Semua User</a>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('js')
<script>
    $(function() {
        // Calendar
        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        });

        // Chart
        var areaChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pendaftar',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90, 45, 32, 67, 23, 78]
            }]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart($('#revenue-chart-canvas'), {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })

        // Donut Chart
        var donutData = {
            labels: [
                'Lunas',
                'Pending',
                'Belum Bayar',
            ],
            datasets: [{
                data: [700, 500, 200],
                backgroundColor: ['#00a65a', '#f39c12', '#dd4b39'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        var donutChart = new Chart($('#sales-chart-canvas'), {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    });
</script>
@endpush