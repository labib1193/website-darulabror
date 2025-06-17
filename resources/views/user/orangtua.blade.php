@extends('layouts.user')

@section('title', 'Data Orangtua/Wali - Dashboard Santri')

@section('page-title', 'Data Orangtua/Wali')

@section('content')
<div class="container-fluid"> <!-- Alert/Keterangan -->
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Informasi Penting:</strong>
        <p class="mb-0">Lengkapi juga data mahrom, diperuntukkan jika keluarga mahrom ingin mengunjungi ke pondok di kemudian hari. Di antara keluarga mahrom seperti, saudara kandung/tiri, paman, bibi, kakek atau nenek dari peserta didik, dll. Jika mahrom terdaftar di lain KK, maka wajib menyertakan & mengupload KK dari mahrom.</p>
    </div>

    <!-- Messages -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <h6><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan:</h6>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-times-circle"></i> {{ session('error') }}
    </div>
    @endif <!-- Main Content Card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title"><i class="fas fa-users"></i> Data Orangtua/Wali</h3>
                <button type="button" id="btn-tambah" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Form Input Data Orangtua -->
            <div id="form-orangtua" class="mb-4" style="display: none;">
                <div class="border rounded p-4 bg-light">
                    <h5 class="mb-3 text-primary"><i class="fas fa-user-plus"></i> Form Input Data Keluarga</h5>

                    <form id="orangtua-form" method="POST" action="{{ route('user.orangtua.store') }}">
                        @csrf
                        <input type="hidden" id="edit_id" name="edit_id" value="">
                        <input type="hidden" id="form_method" name="_method" value="POST">

                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-lg-6">
                                <h6 class="text-secondary mb-3"><i class="fas fa-user"></i> Data Pribadi</h6>

                                <div class="mb-3">
                                    <label for="no_kk" class="form-label">No. KK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_kk" name="no_kk" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nik" name="nik" required maxlength="16">
                                </div>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki" value="Laki-laki" required>
                                            <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_perempuan" value="Perempuan" required>
                                            <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Kakak">Kakak</option>
                                        <option value="Adik">Adik</option>
                                        <option value="Paman">Paman</option>
                                        <option value="Bibi">Bibi</option>
                                        <option value="Kakek">Kakek</option>
                                        <option value="Nenek">Nenek</option>
                                        <option value="Sepupu">Sepupu</option>
                                        <option value="Wali">Wali</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-6">
                                <h6 class="text-secondary mb-3"><i class="fas fa-briefcase"></i> Data Pekerjaan & Kontak</h6>

                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                </div>

                                <div class="mb-3">
                                    <label for="penghasilan" class="form-label">Penghasilan</label>
                                    <select class="form-control" id="penghasilan" name="penghasilan">
                                        <option value="">Pilih Range Penghasilan</option>
                                        <option value="< 1 juta">
                                            < 1 juta</option>
                                        <option value="1-3 juta">1-3 juta</option>
                                        <option value="3-5 juta">3-5 juta</option>
                                        <option value="5-10 juta">5-10 juta</option>
                                        <option value="> 10 juta">> 10 juta</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp_1" class="form-label">No. HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_hp_1" name="no_hp_1" required>
                                </div>

                                <h6 class="text-secondary mb-3"><i class="fas fa-map-marker-alt"></i> Data Alamat</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="provinsi" class="form-label">Provinsi</label>
                                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kabupaten" class="form-label">Kabupaten</label>
                                            <input type="text" class="form-control" id="kabupaten" name="kabupaten">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                            <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kode_pos" class="form-label">Kode Pos</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" maxlength="5">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-secondary" id="btn-batal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Data yang sudah tersimpan -->
            @if($orangtuaList->isEmpty())
            <div id="no-data-message" class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-users fa-4x text-muted"></i>
                </div>
                <h5 class="text-muted mb-2">Belum ada data keluarga</h5>
                <p class="text-muted">Silakan klik tombol "Tambah Data" untuk menambahkan informasi orangtua/wali.</p>
            </div>
            @else
            <div id="data-orangtua-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 text-primary"><i class="fas fa-list"></i> Data Keluarga Tersimpan</h5>
                    <span class="badge bg-info">{{ $orangtuaList->count() }} Data</span>
                </div>

                <div class="row">
                    @foreach($orangtuaList as $orangtua) <div class="col-lg-6 mb-4" id="orangtua-card-{{ $orangtua->id }}">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0 font-weight-bold">{{ $orangtua->nama_lengkap }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-tag"></i> {{ $orangtua->status }}
                                        </small>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-edit" data-id="{{ $orangtua->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $orangtua->id }}" data-name="{{ $orangtua->nama_lengkap }}" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">No. KK:</div>
                                            <div class="col-8 small font-weight-bold">{{ $orangtua->no_kk }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">NIK:</div>
                                            <div class="col-8 small">{{ $orangtua->nik }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">Jenis Kelamin:</div>
                                            <div class="col-8 small">
                                                <span class="badge bg-{{ $orangtua->jenis_kelamin == 'Laki-laki' ? 'primary' : 'pink' }}">
                                                    {{ $orangtua->jenis_kelamin }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">TTL:</div>
                                            <div class="col-8 small">{{ $orangtua->tempat_lahir }}, {{ $orangtua->tanggal_lahir->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">Pendidikan:</div>
                                            <div class="col-8 small">{{ $orangtua->pendidikan_terakhir ?: '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">Pekerjaan:</div>
                                            <div class="col-8 small">{{ $orangtua->pekerjaan ?: '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">Penghasilan:</div>
                                            <div class="col-8 small">{{ $orangtua->penghasilan ?: '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">No. HP:</div>
                                            <div class="col-8 small">
                                                <i class="fas fa-phone text-success"></i> {{ $orangtua->no_hp_1 }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($orangtua->alamat_lengkap || $orangtua->provinsi || $orangtua->kabupaten)
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 text-muted small">Alamat:</div>
                                            <div class="col-8 small">
                                                @if($orangtua->alamat_lengkap)
                                                {{ $orangtua->alamat_lengkap }}
                                                @if($orangtua->kecamatan || $orangtua->kabupaten || $orangtua->provinsi)
                                                <br>
                                                @endif
                                                @endif
                                                @if($orangtua->kecamatan || $orangtua->kabupaten || $orangtua->provinsi)
                                                <span class="text-muted">
                                                    {{ implode(', ', array_filter([$orangtua->kecamatan, $orangtua->kabupaten, $orangtua->provinsi])) }}
                                                    @if($orangtua->kode_pos) {{ $orangtua->kode_pos }} @endif
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let isEditMode = false;
        let editingId = null;

        // Show form when "Tambah" button is clicked
        $('#btn-tambah').click(function() {
            resetForm();
            isEditMode = false;
            editingId = null;
            $('#form-orangtua').slideDown(300);

            // Update form action for create
            $('#orangtua-form').attr('action', '{{ route("user.orangtua.store") }}');
            $('#form_method').val('POST');
            $('#edit_id').val('');

            // Focus on first input
            setTimeout(() => $('#no_kk').focus(), 350);
        }); // Show form when "Ubah" button is clicked
        $(document).on('click', '.btn-edit', function() {
            let orangtuaId = $(this).data('id');
            isEditMode = true;
            editingId = orangtuaId;

            // Show loading state
            $(this).html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

            // Get data via AJAX
            let editUrl = '{{ route("user.orangtua.edit", ":id") }}'.replace(':id', orangtuaId);

            $.get(editUrl, function(data) {
                populateForm(data);
                $('#form-orangtua').slideDown(300);

                // Update form action for update
                $('#orangtua-form').attr('action', '{{ route("user.orangtua.update", ":id") }}'.replace(':id', orangtuaId));
                $('#form_method').val('PUT');
                $('#edit_id').val(orangtuaId);

                // Focus on first input
                setTimeout(() => $('#no_kk').focus(), 350);
            }).fail(function(xhr) {
                showNotification('Terjadi kesalahan saat mengambil data. Silakan coba lagi.', 'danger');
            }).always(function() {
                // Reset button state
                $('.btn-edit[data-id="' + orangtuaId + '"]').html('<i class="fas fa-edit"></i>').prop('disabled', false);
            });
        });

        // Delete button
        $(document).on('click', '.btn-delete', function() {
            let orangtuaId = $(this).data('id');
            let orangtuaName = $(this).data('name');

            // Show confirmation with custom styling
            if (confirm('⚠️ KONFIRMASI HAPUS\n\nApakah Anda yakin ingin menghapus data:\n"' + orangtuaName + '"\n\nData yang dihapus tidak dapat dikembalikan!')) {
                // Show loading state
                $(this).html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
                $.ajax({
                    url: '{{ route("user.orangtua.destroy", ":id") }}'.replace(':id', orangtuaId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Animate card removal
                            $('#orangtua-card-' + orangtuaId).fadeOut(300, function() {
                                $(this).remove();
                                // Check if no more data
                                if ($('#data-orangtua-list .card').length === 0) {
                                    window.location.reload();
                                }
                            });
                            showNotification(response.message, 'success');
                        }
                    },
                    error: function() {
                        showNotification('Terjadi kesalahan saat menghapus data.', 'danger');
                        // Reset button state
                        $('.btn-delete[data-id="' + orangtuaId + '"]').html('<i class="fas fa-trash"></i>').prop('disabled', false);
                    }
                });
            }
        });

        // Hide form when "Batal" button is clicked
        $('#btn-batal').click(function() {
            $('#form-orangtua').slideUp(300);
            resetForm();
            isEditMode = false;
            editingId = null;
        });

        // Handle form submission
        $('#orangtua-form').submit(function(e) {
            e.preventDefault();

            // Show loading state on submit button
            let submitBtn = $(this).find('button[type="submit"]');
            let originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.message, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = 'Terjadi kesalahan validasi:\n\n';

                        Object.keys(errors).forEach(function(key) {
                            errorMessage += '• ' + errors[key][0] + '\n';
                        });

                        showNotification(errorMessage, 'danger');
                    } else {
                        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                    }
                },
                complete: function() {
                    // Reset button state
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
        });

        // Function to reset form
        function resetForm() {
            $('#orangtua-form')[0].reset();
            // Clear any validation states
            $('.form-control, .form-select').removeClass('is-invalid is-valid');
        }

        // Function to populate form with data
        function populateForm(data) {
            $('#no_kk').val(data.no_kk);
            $('#nik').val(data.nik);
            $('#nama_lengkap').val(data.nama_lengkap);
            $('input[name="jenis_kelamin"][value="' + data.jenis_kelamin + '"]').prop('checked', true);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#pendidikan_terakhir').val(data.pendidikan_terakhir);
            $('#no_hp_1').val(data.no_hp_1);
            $('#pekerjaan').val(data.pekerjaan);
            $('#penghasilan').val(data.penghasilan);
            $('#provinsi').val(data.provinsi);
            $('#kabupaten').val(data.kabupaten);
            $('#kecamatan').val(data.kecamatan);
            $('#alamat_lengkap').val(data.alamat_lengkap);
            $('#kode_pos').val(data.kode_pos);
            $('#status').val(data.status);
        }

        // Function to show notifications
        function showNotification(message, type) {
            // Remove existing notifications
            $('.notification-toast').remove();

            // Create notification element
            let notification = $(`
                <div class="notification-toast alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed" 
                     style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${message.replace(/\n/g, '<br>')}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `);

            // Append to body and auto-hide
            $('body').append(notification);
            setTimeout(() => {
                notification.fadeOut(() => notification.remove());
            }, 5000);
        }

        // Input validations
        $('#nik').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16);
        });
        $('#no_hp_1').on('input', function() {
            this.value = this.value.replace(/[^0-9+\-\s]/g, '');
        });

        $('#kode_pos').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 5);
        });

        // Auto-format no KK
        $('#no_kk').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16);
        });
    });
</script>
@endpush