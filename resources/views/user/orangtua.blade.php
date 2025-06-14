@extends('layouts.user')

@section('title', 'Data Orangtua - Dashboard Santri')
@section('page-title', 'Data Orangtua')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('user.identitas') }}">Identitas Diri</a></li>
<li class="breadcrumb-item active">Data Orangtua</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Orangtua/Wali</h3>
                    <button type="button" id="btn-edit" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Ubah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Data Ayah</h5>
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" readonly>
                            </div>
                            <div class="form-group">
                                <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                <select class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" disabled>
                                    <option value="">Pilih Range Penghasilan</option>
                                    <option value="< 1 juta">
                                        < 1 juta</option>
                                    <option value="1-3 juta">1-3 juta</option>
                                    <option value="3-5 juta">3-5 juta</option>
                                    <option value="> 5 juta">> 5 juta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telp_ayah">No. Telp Ayah</label>
                                <input type="tel" class="form-control" id="telp_ayah" name="telp_ayah" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5>Data Ibu</h5>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" readonly>
                            </div>
                            <div class="form-group">
                                <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                <select class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" disabled>
                                    <option value="">Pilih Range Penghasilan</option>
                                    <option value="< 1 juta">
                                        < 1 juta</option>
                                    <option value="1-3 juta">1-3 juta</option>
                                    <option value="3-5 juta">3-5 juta</option>
                                    <option value="> 5 juta">> 5 juta</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telp_ibu">No. Telp Ibu</label>
                                <input type="tel" class="form-control" id="telp_ibu" name="telp_ibu" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Alamat Orangtua</h5>
                            <div class="form-group">
                                <label for="alamat_orangtua">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat_orangtua" name="alamat_orangtua" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="edit-actions" style="display:none;">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                            <button type="button" class="btn btn-secondary ml-2" id="btn-cancel">
                                <i class="fas fa-times"></i> Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#btn-edit').click(function() {
            $('input, select, textarea').prop('readonly', false).prop('disabled', false);
            $('#btn-edit').hide();
            $('#edit-actions').show();
        });

        $('#btn-cancel').click(function() {
            $('input, select, textarea').prop('readonly', true).prop('disabled', true);
            $('#btn-edit').show();
            $('#edit-actions').hide();
        });
    });
</script>
@endpush