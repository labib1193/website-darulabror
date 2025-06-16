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
                <h3 class="card-title"><i class="fas fa-user"></i> Data Identitas Diri</h3>
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
                </div>

                <!-- NIK -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" class="form-control editable-field" readonly
                            value="{{ $identitas->nik ?? '-' }}"
                            placeholder="Nomor Induk Kependudukan">
                    </div>
                </div>

                <!-- Tempat Lahir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                        <input type="text" name="tempat_lahir" class="form-control editable-field" readonly
                            value="{{ $identitas->tempat_lahir ?? '-' }}"
                            placeholder="Tempat Lahir">
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal_lahir" class="form-control editable-field" readonly
                            value="{{ $identitas->tanggal_lahir ? $identitas->tanggal_lahir->format('Y-m-d') : '' }}">
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
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
                </div>

                <!-- Pendidikan Terakhir -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                    <div class="col-sm-9">
                        <input type="text" name="pendidikan_terakhir" class="form-control editable-field" readonly
                            value="{{ $identitas->pendidikan_terakhir ?? '-' }}"
                            placeholder="Pendidikan terakhir">
                    </div>
                </div>

                <!-- No. HP 1 -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">No. HP 1</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_hp_1" class="form-control editable-field" readonly
                            value="{{ $identitas->no_hp_1 ?? '-' }}"
                            placeholder="Nomor HP Utama">
                    </div>
                </div>

                <!-- No. HP 2 -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">No. HP 2</label>
                    <div class="col-sm-9">
                        <input type="text" name="no_hp_2" class="form-control editable-field" readonly
                            value="{{ $identitas->no_hp_2 ?? '-' }}"
                            placeholder="Nomor HP Alternatif (Opsional)">
                    </div>
                </div>

                <!-- Provinsi -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Provinsi</label>
                    <div class="col-sm-9">
                        <input type="text" name="provinsi" class="form-control editable-field" readonly
                            value="{{ $identitas->provinsi ?? '-' }}"
                            placeholder="Provinsi">
                    </div>
                </div>

                <!-- Kabupaten -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Kabupaten</label>
                    <div class="col-sm-9">
                        <input type="text" name="kabupaten" class="form-control editable-field" readonly
                            value="{{ $identitas->kabupaten ?? '-' }}"
                            placeholder="Kabupaten/Kota">
                    </div>
                </div>

                <!-- Kecamatan -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-9">
                        <input type="text" name="kecamatan" class="form-control editable-field" readonly
                            value="{{ $identitas->kecamatan ?? '-' }}"
                            placeholder="Kecamatan">
                    </div>
                </div>

                <!-- Alamat Lengkap -->
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <textarea name="alamat_lengkap" class="form-control editable-field" readonly
                            rows="3" placeholder="Alamat lengkap">{{ $identitas->alamat_lengkap ?? '-' }}</textarea>
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
        }

        // Add input validation feedback
        editableFields.forEach(field => {
            field.addEventListener('input', function() {
                if (this.hasAttribute('required') && this.value.trim()) {
                    this.style.borderColor = '#28a745';
                } else if (this.hasAttribute('required') && !this.value.trim()) {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = '#007bff';
                }
            });

            field.addEventListener('blur', function() {
                if (!this.readOnly && !this.disabled) {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.style.borderColor = '#dc3545';
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection