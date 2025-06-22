@extends('layouts.admin')

@section('title', 'Detail Pesan - ')
@section('page-title', 'Detail Pesan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Kritik & Saran</a></li>
<li class="breadcrumb-item active">Detail Pesan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-envelope-open"></i> Detail Pesan dari {{ $contact->nama }}
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" id="deleteBtn" data-id="{{ $contact->id }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Message Content -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-comment"></i> Pesan
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="message-content" style="line-height: 1.6; font-size: 16px;">
                                    {!! nl2br(e($contact->pesan)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Contact Information -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user"></i> Informasi Pengirim
                                </h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ $contact->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>
                                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal:</strong></td>
                                        <td>{{ $contact->created_at->format('d F Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            @if($contact->status === 'unread')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-envelope"></i> Belum Dibaca
                                            </span>
                                            @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-envelope-open"></i> Sudah Dibaca
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($contact->read_at)
                                    <tr>
                                        <td><strong>Dibaca pada:</strong></td>
                                        <td>{{ $contact->read_at->format('d F Y, H:i') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-tools"></i> Tindakan Cepat
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $contact->email }}&su=Re:%20Pesan%20Anda%20di%20Website%20Pondok%20Pesantren%20Darul%20Abror&body=Terima%20kasih%20atas%20pesan%20Anda.%0A%0APesan%20Anda:%0A{{ urlencode($contact->pesan) }}%0A%0ABalasan%20kami:"
                                        target="_blank" class="btn btn-primary btn-block">
                                        <i class="fas fa-reply"></i> Balas via Email
                                    </a>

                                    @if($contact->status === 'unread')
                                    <button type="button" class="btn btn-warning btn-block" id="markAsReadBtn">
                                        <i class="fas fa-check"></i> Tandai Sudah Dibaca
                                    </button>
                                    @endif

                                    <button type="button" class="btn btn-outline-danger btn-block" id="deleteDetailBtn">
                                        <i class="fas fa-trash"></i> Hapus Pesan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Mark as read
        $('#markAsReadBtn').on('click', function() {
            $.ajax({
                url: `/admin/contact/{{ $contact->id }}/mark-as-read`,
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menandai pesan sebagai dibaca.');
                }
            });
        });

        // Delete message
        $('#deleteBtn, #deleteDetailBtn').on('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                $.ajax({
                    url: `/admin/contact/{{ $contact->id }}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '{{ route("admin.contact.index") }}';
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat menghapus pesan.');
                    }
                });
            }
        });
    });
</script>
@endpush