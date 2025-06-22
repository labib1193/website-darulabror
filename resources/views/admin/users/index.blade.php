@extends('layouts.admin')

@section('title', 'Manajemen User - ')
@section('page-title', 'Manajemen User')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Manajemen User</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users-cog"></i> Daftar User
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(Auth::user()->role !== 'superadmin')
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Informasi Akses Admin</h5>
                    Sebagai <strong>Admin</strong>, Anda hanya dapat melihat dan mengelola <strong>User biasa</strong>.
                    Untuk melihat daftar Admin dan Super Admin lainnya, diperlukan akses <strong>Super Admin</strong>.
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
                @endif <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="usersTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Status Email</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody> @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td class="text-center">
                                    @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                        alt="{{ $user->name }}"
                                        class="img-circle elevation-2"
                                        width="40" height="40">
                                    @else
                                    <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}"
                                        alt="Default Avatar"
                                        class="img-circle elevation-2"
                                        width="40" height="40">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                    <span class="badge badge-success">
                                        <i class="fas fa-user-shield"></i> Admin
                                    </span>
                                    @elseif($user->role == 'superadmin')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-crown"></i> Super Admin
                                    </span>
                                    @else
                                    <span class="badge badge-primary">
                                        <i class="fas fa-user"></i> User
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status == 'active')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Nonaktif
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $user->getEmailVerificationBadgeClass() }}">
                                        <i class="fas {{ $user->isEmailVerified() ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                        {{ $user->getEmailVerificationStatus() }}
                                    </span>
                                    @if($user->email_verified_at)
                                    <small class="text-muted d-block">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a> @if($user->role != 'superadmin' && Auth::user()->id != $user->id)
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email }}"
                                            data-user-role="{{ $user->role }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }}
                            dari {{ $users->total() }} total data
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteUserModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus User
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus user ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Detail User yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama:</strong></td>
                                <td id="delete-user-name">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="delete-user-email">-</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>
                                    <span id="delete-user-role" class="badge">-</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Semua data terkait user ini juga akan terhapus (identitas, dokumen, pembayaran, dll.)
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteUserForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<!-- Admin DataTables Styling -->
<link rel="stylesheet" href="{{ asset('assets/css/admin/datatables.css') }}">
@endpush

@push('scripts')
<script>
    $(document).ready(function() { // Initialize DataTable without search and pagination
        var table = $('#usersTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false, // Disable all sorting
            "columnDefs": []
        });

        // Delete user confirmation with AdminLTE modal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            var userEmail = $(this).data('user-email');
            var userRole = $(this).data('user-role');

            console.log('Delete button clicked for user:', userId, userName); // Debug log

            // Set form action URL
            $('#deleteUserForm').attr('action', '/admin/users/' + userId);

            // Fill modal with user data
            $('#delete-user-name').text(userName);
            $('#delete-user-email').text(userEmail);

            // Set role badge with appropriate color
            var roleBadge = $('#delete-user-role');
            roleBadge.removeClass('badge-primary badge-success badge-danger');

            if (userRole === 'admin') {
                roleBadge.addClass('badge-success').text('Administrator');
            } else if (userRole === 'superadmin') {
                roleBadge.addClass('badge-danger').text('Super Administrator');
            } else {
                roleBadge.addClass('badge-primary').text('User');
            }

            // Show modal
            $('#deleteUserModal').modal('show');
        });
    });
</script>
@endpush