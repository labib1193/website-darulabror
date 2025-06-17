@extends('layouts.user')

@section('title', 'Identitas Diri - Dashboard Santri')
@section('page-title', 'Identitas Diri')

@section('content')
<div class="container-fluid"> <!-- Informational Alert -->
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-info-circle"></i>
        <strong>Informasi:</strong> Halaman ini berisi data identitas diri Anda. Klik tombol "Ubah Data" untuk mengedit informasi yang diperlukan.
    </div>

    <!-- Alert Messages --> @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fas fa-times-circle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan:</h6>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif <!-- Identitas Card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-user"></i> Data Identitas Diri
                    @if($identitas && $identitas->status_verifikasi)
                    @if($identitas->status_verifikasi == 'terverifikasi')
                    <span class="badge badge-success ml-2">Terverifikasi</span>
                    @elseif($identitas->status_verifikasi == 'pending')
                    <span class="badge badge-warning ml-2">Pending</span>
                    @else
                    <span class="badge badge-danger ml-2">Belum Diverifikasi</span>
                    @endif
                    @else
                    <span class="badge badge-secondary ml-2">Data Kosong</span>
                    @endif
                </h3>
                <div id="action-buttons">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-edit">
                        <i class="fas fa-edit"></i> Ubah Data
                    </button>
                    <div id="edit-buttons" style="display: none;">
                        <button type="button" class="btn btn-success btn-sm me-2" id="btn-save">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-cancel">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="identitas-form" action="{{ route('user.identitas.update') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-plaintext" readonly value="{{ Auth::user()->name }}" style="background: transparent; border: none;">
                    </div>
                </div>

                <!-- No. KK -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">No. KK</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_kk" class="form-control editable-field" readonly
                            value="{{ $identitas->no_kk ?? '-' }}"
                            placeholder="Nomor Kartu Keluarga">
                    </div>
                </div> <!-- NIK -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        NIK <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" class="form-control editable-field" readonly
                            value="{{ $identitas->nik ?? '' }}"
                            placeholder="Nomor Induk Kependudukan (16 digit)"
                            pattern="[0-9]{16}"
                            maxlength="16">
                        <small class="form-text text-muted">16 digit angka sesuai KTP</small>
                    </div>
                </div>

                <!-- Tempat Lahir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Tempat Lahir <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="tempat_lahir" class="form-control editable-field" readonly
                            value="{{ $identitas->tempat_lahir ?? '' }}"
                            placeholder="Tempat Lahir">
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Tanggal Lahir <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal_lahir" class="form-control editable-field" readonly
                            value="{{ $identitas->tanggal_lahir ? $identitas->tanggal_lahir->format('Y-m-d') : '' }}">
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Jenis Kelamin <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <select name="jenis_kelamin" class="form-control editable-field" disabled>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ ($identitas->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ ($identitas->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- Anak Ke -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Anak Ke</label>
                    <div class="col-sm-9">
                        <input type="number" name="anak_ke" class="form-control editable-field" readonly
                            value="{{ $identitas->anak_ke ?? '' }}"
                            placeholder="Anak ke berapa" min="1">
                    </div>
                </div>

                <!-- Jumlah Saudara -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Jumlah Saudara</label>
                    <div class="col-sm-9">
                        <input type="number" name="jumlah_saudara" class="form-control editable-field" readonly
                            value="{{ $identitas->jumlah_saudara ?? '' }}"
                            placeholder="Jumlah saudara kandung" min="0">
                    </div>
                </div>

                <!-- Tinggal Bersama -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Tinggal Bersama</label>
                    <div class="col-sm-9">
                        <input type="text" name="tinggal_bersama" class="form-control editable-field" readonly
                            value="{{ $identitas->tinggal_bersama ?? '-' }}"
                            placeholder="Tinggal bersama siapa">
                    </div>
                </div> <!-- Pendidikan Terakhir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                    <div class="col-sm-9">
                        <input type="text" name="pendidikan_terakhir" class="form-control editable-field" readonly
                            value="{{ $identitas->pendidikan_terakhir ?? '-' }}"
                            placeholder="Pendidikan terakhir">
                    </div>
                </div>

                <!-- Pekerjaan -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Pekerjaan</label>
                    <div class="col-sm-9">
                        <input type="text" name="pekerjaan" class="form-control editable-field" readonly
                            value="{{ $identitas->pekerjaan ?? '-' }}"
                            placeholder="Pekerjaan saat ini">
                    </div>
                </div><!-- No. HP -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        No. HP <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="no_hp" class="form-control editable-field" readonly
                            value="{{ $identitas->no_hp ?? '' }}"
                            placeholder="Nomor HP (contoh: 08123456789)"
                            pattern="^08[0-9]{8,11}$"
                            maxlength="13">
                        <small class="form-text text-muted">Format: 08xxxxxxxxx (8-13 digit)</small>
                    </div>
                </div> <!-- Provinsi -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Provinsi <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="provinsi" class="form-control editable-field" readonly
                            value="{{ $identitas->provinsi ?? '' }}"
                            placeholder="Provinsi">
                    </div>
                </div>

                <!-- Kabupaten -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Kabupaten <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="kabupaten" class="form-control editable-field" readonly
                            value="{{ $identitas->kabupaten ?? '' }}"
                            placeholder="Kabupaten/Kota">
                    </div>
                </div> <!-- Kecamatan -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Kecamatan <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="kecamatan" class="form-control editable-field" readonly
                            value="{{ $identitas->kecamatan ?? '' }}"
                            placeholder="Kecamatan">
                    </div>
                </div>

                <!-- Desa/Kelurahan -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Desa/Kelurahan <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="desa" class="form-control editable-field" readonly
                            value="{{ $identitas->desa ?? '' }}"
                            placeholder="Desa/Kelurahan">
                    </div>
                </div>

                <!-- Alamat Lengkap -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">
                        Alamat Lengkap <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <textarea name="alamat_lengkap" class="form-control editable-field" readonly
                            rows="3" placeholder="Alamat lengkap termasuk RT/RW">{{ $identitas->alamat_lengkap ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Kode Pos -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Kode Pos</label>
                    <div class="col-sm-9">
                        <input type="text" name="kode_pos" class="form-control editable-field" readonly
                            value="{{ $identitas->kode_pos ?? '-' }}"
                            placeholder="Kode Pos">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript for edit functionality --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnEdit = document.getElementById('btn-edit');
        const btnSave = document.getElementById('btn-save');
        const btnCancel = document.getElementById('btn-cancel');
        const editButtons = document.getElementById('edit-buttons');
        const editableFields = document.querySelectorAll('.editable-field');
        const form = document.getElementById('identitas-form');

        let originalValues = {};

        // Simpan nilai asli saat pertama kali load
        editableFields.forEach(field => {
            if (field.type === 'checkbox' || field.type === 'radio') {
                originalValues[field.name] = field.checked;
            } else {
                originalValues[field.name] = field.value;
            }
        });

        // Event listener untuk tombol Ubah
        btnEdit.addEventListener('click', function() {
            // Add loading state
            btnEdit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            btnEdit.disabled = true;

            setTimeout(() => {
                // Sembunyikan tombol Ubah, tampilkan tombol Simpan & Batal
                btnEdit.style.display = 'none';
                editButtons.style.display = 'inline-flex';

                // Aktifkan semua field yang bisa diedit
                editableFields.forEach(field => {
                    if (field.tagName.toLowerCase() === 'select') {
                        field.disabled = false;
                    } else {
                        field.readOnly = false;
                    }
                    field.style.background = '#fff';
                    field.style.border = '2px solid #007bff';
                    field.style.paddingLeft = '0.75rem';
                });

                // Focus on first editable field
                const firstField = editableFields[0];
                if (firstField) {
                    firstField.focus();
                }

                // Reset button state
                btnEdit.innerHTML = '<i class="fas fa-edit"></i> Ubah';
                btnEdit.disabled = false;
            }, 300);
        });

        // Event listener untuk tombol Batal
        btnCancel.addEventListener('click', function() {
            // Add confirmation
            if (confirm('Apakah Anda yakin ingin membatalkan perubahan? Semua data yang belum disimpan akan hilang.')) {
                // Kembalikan ke mode view
                resetToViewMode();

                // Kembalikan nilai asli
                editableFields.forEach(field => {
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = originalValues[field.name] || false;
                    } else {
                        field.value = originalValues[field.name] || '';
                    }
                });

                showNotification('Perubahan dibatalkan', 'info');
            }
        });

        // Event listener untuk tombol Simpan
        btnSave.addEventListener('click', function() {
            // Add loading state
            btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            btnSave.disabled = true;
            btnCancel.disabled = true;

            // Validate required fields
            let isValid = true;
            editableFields.forEach(field => {
                if (field.hasAttribute('required') && !field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#007bff';
                }
            });

            if (isValid) {
                // Submit form
                form.submit();
            } else {
                showNotification('Mohon lengkapi semua field yang wajib diisi', 'danger');
                // Reset button state
                btnSave.innerHTML = '<i class="fas fa-save"></i> Simpan';
                btnSave.disabled = false;
                btnCancel.disabled = false;
            }
        });

        // Fungsi untuk reset ke mode view
        function resetToViewMode() {
            // Tampilkan tombol Ubah, sembunyikan tombol Simpan & Batal
            btnEdit.style.display = 'inline-block';
            editButtons.style.display = 'none';

            // Nonaktifkan semua field
            editableFields.forEach(field => {
                if (field.tagName.toLowerCase() === 'select') {
                    field.disabled = true;
                } else {
                    field.readOnly = true;
                }
                field.style.background = 'transparent';
                field.style.border = 'none';
                field.style.paddingLeft = '0';
            });
        }

        // Function to show notifications
        function showNotification(message, type) {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notification => notification.remove());

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification-toast alert alert-${type === 'success' ? 'success' : type === 'info' ? 'info' : 'danger'} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-triangle'}"></i>
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            `;

            // Append to body and auto-hide
            document.body.appendChild(notification);
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.style.opacity = '0';
                    setTimeout(() => notification.remove(), 300);
                }
            }, 4000);
        } // Add input validation feedback
        editableFields.forEach(field => {
            field.addEventListener('input', function() {
                validateField(this);
            });

            field.addEventListener('blur', function() {
                if (!this.readOnly && !this.disabled) {
                    validateField(this);
                }
            });
        });

        // Field validation function
        function validateField(field) {
            const isRequired = field.hasAttribute('required') || field.name === 'nik' || field.name === 'tempat_lahir' || field.name === 'tanggal_lahir' || field.name === 'jenis_kelamin' || field.name === 'no_hp' || field.name === 'provinsi' || field.name === 'kabupaten' || field.name === 'kecamatan' || field.name === 'desa' || field.name === 'alamat_lengkap';

            if (field.readOnly || field.disabled) return;

            // Remove existing feedback
            const feedback = field.parentNode.querySelector('.invalid-feedback');
            if (feedback) feedback.remove();

            let isValid = true;
            let message = '';

            if (isRequired && !field.value.trim()) {
                isValid = false;
                message = 'Field ini harus diisi';
            } else if (field.name === 'nik' && field.value.trim()) {
                if (!/^[0-9]{16}$/.test(field.value)) {
                    isValid = false;
                    message = 'NIK harus berupa 16 digit angka';
                }
            } else if (field.name === 'no_hp' && field.value.trim()) {
                if (!/^08[0-9]{8,11}$/.test(field.value)) {
                    isValid = false;
                    message = 'Nomor HP harus diawali 08 dan berisi 10-13 digit';
                }
            }

            // Apply visual feedback
            if (isValid) {
                field.style.borderColor = field.value.trim() ? '#28a745' : '#007bff';
                field.classList.remove('is-invalid');
            } else {
                field.style.borderColor = '#dc3545';
                field.classList.add('is-invalid');

                // Add error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = message;
                field.parentNode.appendChild(errorDiv);
            }
        }

        // Form validation before submit
        btnSave.addEventListener('click', function() {
            let hasErrors = false;
            editableFields.forEach(field => {
                validateField(field);
                if (field.classList.contains('is-invalid')) {
                    hasErrors = true;
                }
            });

            if (hasErrors) {
                showNotification('Mohon perbaiki kesalahan pada form sebelum menyimpan', 'error');
                return;
            }

            // Submit form
            form.submit();
        });
    });
</script>
@endpush
@push('styles')
<style>
    .form-group .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-control:valid:not(.form-control-plaintext) {
        border-color: #28a745;
    }

    .badge {
        font-size: 0.75em;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .card-header .card-title {
        font-weight: 600;
        margin-bottom: 0;
    }

    .form-text.text-muted {
        font-size: 0.8em;
        font-style: italic;
    }

    .notification-toast {
        animation: slideInRight 0.3s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .editable-field:not([readonly]):not([disabled]) {
        transition: all 0.3s ease;
    }

    .editable-field:not([readonly]):not([disabled]):hover {
        border-color: #007bff;
        box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.1);
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.875em;
        color: #dc3545;
        margin-top: 0.25rem;
    }
</style>
@endpush
@endsection