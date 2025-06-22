@extends('layouts.admin')

@section('title')
@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
<!-- Add any custom CSS for dashboard -->
<style>
    /* Profile image consistency fixes */
    .users-list>li>img {
        border-radius: 50%;
        width: 60px !important;
        height: 60px !important;
        object-fit: cover;
        object-position: center;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .user-panel .image img {
        width: 35px !important;
        height: 35px !important;
        object-fit: cover;
        object-position: center;
    }

    /* Responsive user list */
    @media (max-width: 767px) {
        .users-list>li {
            width: 50% !important;
        }

        .users-list>li>img {
            width: 50px !important;
            height: 50px !important;
        }
    }

    @media (max-width: 575px) {
        .users-list>li {
            width: 100% !important;
        }
    }

    /* Better layout for user list names */
    .users-list .users-list-name {
        font-weight: 600;
        color: #495057;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 100%;
        display: block;
    }
</style>
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
                <h3>{{ $pembayaranTerverifikasi ?? 0 }}</h3>
                <p>Pembayaran Terverifikasi</p>
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
                <h3>{{ $pembayaranPending ?? 0 }}</h3>
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
<div class="row"> <!-- Left col -->
    <section class="col-lg-8 connectedSortable">

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

                    @forelse($recentActivities ?? [] as $activity)
                    <!-- timeline item -->
                    <div>
                        <i class="{{ $activity['icon'] }}"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{ $activity['time']->diffForHumans() }}</span>
                            <h3 class="timeline-header">{{ $activity['title'] }}</h3>
                            <div class="timeline-body">
                                {{ $activity['description'] }}
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    @empty
                    <!-- default timeline item -->
                    <div>
                        <i class="fas fa-user bg-info"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> Baru saja</span>
                            <h3 class="timeline-header">Selamat datang di Dashboard Admin</h3>
                            <div class="timeline-body">
                                Belum ada aktivitas terbaru. Silakan kelola data pendaftar.
                            </div>
                        </div>
                    </div>
                    @endforelse

                    <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.Left col --> <!-- Right col (fixed) -->
    <section class="col-lg-4 connectedSortable">
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
                            <i class="fas fa-money-check-alt"></i> Pembayaran
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-file-alt"></i> Verifikasi Dokumen
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
                <ul class="users-list clearfix"> @forelse($recentUsers ?? [] as $user) <li>
                        <img src="{{ $user->profile_photo_url ?? asset('AdminLTE/dist/img/user2-160x160.jpg') }}"
                            alt="{{ $user->name }}"
                            title="{{ $user->name }}"
                            class="user-profile-img"
                            data-fallback="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}"
                            loading="lazy">
                        <a class="users-list-name" href="#" title="{{ $user->name }}">{{ Str::limit($user->name, 12) }}</a>
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
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Handle profile image fallback
        $('.user-profile-img').on('error', function() {
            const fallbackUrl = $(this).data('fallback');
            if (this.src !== fallbackUrl) {
                this.src = fallbackUrl;
            }
        });

        // Auto refresh setiap 5 menit untuk data terbaru
        setInterval(function() {
            // Refresh data statistik tanpa reload halaman
            $.get(window.location.href, function(data) {
                // Update widget numbers jika diperlukan
                console.log('Data dashboard auto-refreshed');
            });
        }, 300000); // 5 menit = 300000ms
    });
</script>
@endpush