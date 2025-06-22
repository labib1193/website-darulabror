@extends('layouts.admin')

@section('title', 'Tambah Data Dokumen - ')
@section('page-title', 'Tambah Data Dokumen')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.dokumen.index') }}">Data Dokumen</a></li>
<li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data Dokumen</h3>
            </div>
            <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">User <span class="text-danger">*</span></label>
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">Pilih User</option>
                            @foreach(\App\Models\User::where('role', 'user')->get() as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_ktp">Foto KTP</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_ktp') is-invalid @enderror"
                                            id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_ktp">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_ijazah">Foto Ijazah</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_ijazah') is-invalid @enderror"
                                            id="foto_ijazah" name="foto_ijazah" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_ijazah">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surat_sehat">Surat Sehat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('surat_sehat') is-invalid @enderror"
                                            id="surat_sehat" name="surat_sehat" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="surat_sehat">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('surat_sehat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_kk">Foto Kartu Keluarga</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_kk') is-invalid @enderror"
                                            id="foto_kk" name="foto_kk" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_kk">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pas_foto">Pas Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('pas_foto') is-invalid @enderror"
                                            id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="pas_foto">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                @error('pas_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_verifikasi">Status Verifikasi <span class="text-danger">*</span></label>
                                <select class="form-control @error('status_verifikasi') is-invalid @enderror"
                                    id="status_verifikasi" name="status_verifikasi" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status_verifikasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status_verifikasi') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="rejected" {{ old('status_verifikasi') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status_verifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catatan_verifikasi">Catatan Verifikasi</label>
                        <textarea class="form-control @error('catatan_verifikasi') is-invalid @enderror"
                            id="catatan_verifikasi" name="catatan_verifikasi" rows="3"
                            placeholder="Catatan untuk verifikasi dokumen...">{{ old('catatan_verifikasi') }}</textarea>
                        @error('catatan_verifikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Custom file input labels
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush