@extends('layouts.user')

@section('title', 'Dokumen - Dashboard Santri')
@section('page-title', 'Upload Dokumen')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('user.identitas') }}">Identitas Diri</a></li>
<li class="breadcrumb-item active">Dokumen</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dokumen Persyaratan</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Silakan upload dokumen-dokumen yang diperlukan untuk pendaftaran santri baru.</p>

                <form enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ktp">Foto KTP Orangtua <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktp" name="ktp" accept="image/*">
                                        <label class="custom-file-label" for="ktp">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kk">Foto Kartu Keluarga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="kk" name="kk" accept="image/*">
                                        <label class="custom-file-label" for="kk">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ijazah">Foto Ijazah Terakhir</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ijazah" name="ijazah" accept="image/*">
                                        <label class="custom-file-label" for="ijazah">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pas_foto">Pas Foto 3x4 <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="pas_foto" name="pas_foto" accept="image/*">
                                        <label class="custom-file-label" for="pas_foto">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maksimal 1MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surat_keterangan">Surat Keterangan Sehat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="surat_keterangan" name="surat_keterangan" accept="image/*,application/pdf">
                                        <label class="custom-file-label" for="surat_keterangan">Pilih file...</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG, PDF. Maksimal 2MB</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Dokumen
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Upload -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Status Upload Dokumen</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Status</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KTP Orangtua</td>
                                <td><span class="badge badge-warning">Belum Upload</span></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Kartu Keluarga</td>
                                <td><span class="badge badge-warning">Belum Upload</span></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Pas Foto 3x4</td>
                                <td><span class="badge badge-warning">Belum Upload</span></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update label saat file dipilih
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush