@extends('layouts.admin')

@section('title', 'Kritik & Saran - ')
@section('page-title', 'Kritik & Saran')

@push('css')
<style>
    /* Force action column to always be visible */
    #contactTable th:last-child,
    #contactTable td:last-child {
        min-width: 120px !important;
        width: 120px !important;
        white-space: nowrap !important;
    }

    /* Ensure table is responsive without DataTable responsive feature */
    .table-responsive {
        overflow-x: auto;
        min-height: 400px;
        -webkit-overflow-scrolling: touch;
    }

    /* Make sure table doesn't break on small screens */
    #contactTable {
        min-width: 800px;
    }

    /* Make sure buttons are properly sized */
    .btn-group .btn {
        margin-right: 2px;
    }

    /* Hide responsive control column that might cause + - buttons */
    .dtr-control {
        display: none !important;
    }
</style>
@endpush

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Kritik & Saran</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments"></i> Daftar Pesan dari Publik
                </h3>
                <div class="card-tools">
                    @if($unreadCount > 0)
                    <span class="badge badge-danger mr-2">{{ $unreadCount }} Belum Dibaca</span>
                    <button type="button" class="btn btn-info btn-sm mr-2" id="markAllAsReadBtn">
                        <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                    </button>
                    @endif
                    <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedBtn" disabled>
                        <i class="fas fa-trash"></i> Hapus Terpilih
                    </button>
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

                <!-- Filter Status -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="statusFilter">Filter Status:</label>
                        <select id="statusFilter" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="unread">Belum Dibaca</option>
                            <option value="read">Sudah Dibaca</option>
                        </select>
                    </div>
                </div> <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="contactTable">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 30px;">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                            <tr class="{{ $contact->status === 'unread' ? 'table-warning' : '' }}">
                                <td>
                                    <input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}">
                                </td>
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
                                <td>{{ $contact->nama }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $contact->pesan }}
                                    </div>
                                </td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td style="min-width: 120px; white-space: nowrap;">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact.show', $contact->id) }}"
                                            class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($contact->status === 'unread')
                                        <button type="button" class="btn btn-warning btn-sm mark-as-read-btn"
                                            data-id="{{ $contact->id }}" title="Tandai Dibaca">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                            data-id="{{ $contact->id }}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <br>Belum ada pesan dari publik
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() { // Initialize DataTable
        const table = $('#contactTable').DataTable({
            responsive: false, // Disable responsive to remove + - buttons
            pageLength: 10,
            ordering: false, // Disable all sorting
            columnDefs: [{
                orderable: false,
                targets: '_all' // Disable ordering for all columns
            }]
        });

        // Status filter
        $('#statusFilter').on('change', function() {
            const status = $(this).val();
            if (status === '') {
                table.column(1).search('').draw();
            } else {
                const searchTerm = status === 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca';
                table.column(1).search(searchTerm).draw();
            }
        });

        // Select all checkbox
        $('#selectAll').on('change', function() {
            $('.contact-checkbox:visible').prop('checked', this.checked);
            toggleDeleteButton();
        });

        // Individual checkbox
        $(document).on('change', '.contact-checkbox', function() {
            const totalCheckboxes = $('.contact-checkbox:visible').length;
            const checkedCheckboxes = $('.contact-checkbox:visible:checked').length;

            $('#selectAll').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
            $('#selectAll').prop('checked', checkedCheckboxes === totalCheckboxes);

            toggleDeleteButton();
        });

        function toggleDeleteButton() {
            const checkedCount = $('.contact-checkbox:checked').length;
            $('#deleteSelectedBtn').prop('disabled', checkedCount === 0);
        }

        // Mark as read
        $(document).on('click', '.mark-as-read-btn', function() {
            const contactId = $(this).data('id');
            const button = $(this);

            $.ajax({
                url: `/admin/contact/${contactId}/mark-as-read`,
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

        // Mark all as read
        $('#markAllAsReadBtn').on('click', function() {
            if (confirm('Tandai semua pesan sebagai sudah dibaca?')) {
                $.ajax({
                    url: '{{ route("admin.contact.markAllAsRead") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat menandai semua pesan sebagai dibaca.');
                    }
                });
            }
        });

        // Delete single
        $(document).on('click', '.delete-btn', function() {
            const contactId = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                $.ajax({
                    url: `/admin/contact/${contactId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat menghapus pesan.');
                    }
                });
            }
        });

        // Delete multiple
        $('#deleteSelectedBtn').on('click', function() {
            const selectedIds = $('.contact-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                alert('Pilih pesan yang ingin dihapus.');
                return;
            }

            if (confirm(`Apakah Anda yakin ingin menghapus ${selectedIds.length} pesan yang dipilih?`)) {
                $.ajax({
                    url: '{{ route("admin.contact.destroyMultiple") }}',
                    method: 'POST',
                    data: {
                        ids: selectedIds
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
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