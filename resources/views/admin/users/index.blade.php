@extends('layouts.admin')

@section('title', 'Manajemen User')
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
                <h3 class="card-title">Daftar User</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                </div>
            </div>
            <div class="card-body">
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
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="usersTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status Verifikasi Email</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
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
                                    @if($user->email_verified_at)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Terverifikasi
                                    </span>
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Belum Verifikasi
                                    </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->role != 'superadmin' && Auth::user()->id != $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": true,
            "ordering": true,
            "language": {
                "search": "Cari:",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "emptyTable": "Tidak ada data tersedia"
            }
        });
    });
</script>
@endpush