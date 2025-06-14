<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Dashboard Santri</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">Dashboard Santri</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Identitas Diri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.orangtua') }}" class="nav-link {{ request()->is('orangtua') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>Orang Tua</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.dokumen') }}" class="nav-link {{ request()->is('upload-berkas') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Upload Berkas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.pembayaran') }}" class="nav-link {{ request()->is('pembayaran') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.cetakpdf') }}" class="nav-link {{ request()->is('cetak-pendaftaran') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Cetak Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.pengaturanakun') }}" class="nav-link {{ request()->is('pengaturan-akun') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Pengaturan Akun</p>
                            </a>
                        </li>
                        <form action="{{ route('user.auth.logout') }}" method="POST">
                            @csrf
                            <li class="nav-item">
                                <button type="submit" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </button>
                            </li>
                        </form>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-4"> @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Identitas Diri</h5>
                        <div class="d-flex gap-2">
                            <button type="button" id="btn-edit" class="btn btn-primary btn-sm">Ubah</button>
                            <div id="edit-actions" style="display:none;">
                                <button type="button" class="btn btn-success btn-sm me-2">Simpan</button>
                                <button type="button" class="btn btn-danger btn-sm">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                    $authUser = Auth::user();
                    $identitas = $authUser->identitas;

                    $user = [
                    'nama_lengkap' => $authUser->name ?? '',
                    'jenis_kelamin' => $authUser->jenis_kelamin ?? '',
                    'no_hp' => $authUser->no_hp ?? '',
                    'tempat_lahir' => $identitas->tempat_lahir ?? '',
                    'tanggal_lahir' => $identitas->tanggal_lahir ?? '',
                    'anak_ke' => $identitas->anak_ke ?? '',
                    'jumlah_saudara' => $identitas->jumlah_saudara ?? '',
                    'tinggal_bersama' => $identitas->tinggal_bersama ?? '',
                    'pendidikan_terakhir' => $identitas->pendidikan_terakhir ?? '',
                    'alamat' => $identitas->alamat ?? '',
                    'ukuran_seragam' => $identitas->ukuran_seragam ?? '',
                    'golongan_darah' => $identitas->golongan_darah ?? '',
                    'hobi' => $identitas->hobi ?? '',
                    'status_keluarga' => $identitas->status_keluarga ?? '',
                    ];
                    @endphp <form id="identitasForm" method="POST">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Nama Lengkap</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['nama_lengkap'] }}</span>
                                <input class="form-control edit-mode" name="nama_lengkap" value="{{ $user['nama_lengkap'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">NEFart</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['nama_lengkap'] }}</span>
                                <input class="form-control edit-mode" name="nama_lengkap" value="{{ $user['nama_lengkap'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Jenis Kelamin</div>
                            <div class="col-md-8"> <span class="view-mode">{{ $authUser->formatted_gender }}</span>
                                <select class="form-control edit-mode" name="jenis_kelamin" style="display:none;">
                                    <option value="L" {{ $authUser->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
                                    <option value="P" {{ $authUser->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Tempat Lahir</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['tempat_lahir'] }}</span>
                                <input class="form-control edit-mode" name="tempat_lahir" value="{{ $user['tempat_lahir'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Tanggal Lahir</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ date('d-m-Y', strtotime($user['tanggal_lahir'])) }}</span>
                                <input type="date" class="form-control edit-mode" name="tanggal_lahir" value="{{ $user['tanggal_lahir'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Usia</div>
                            <div class="col-md-8">
                                <span id="usia-view">{{ $authUser->identitas ? $authUser->identitas->usia : '-' }}</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Anak ke</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['anak_ke'] }} dari {{ $user['jumlah_saudara'] }} bersaudara</span>
                                <div class="edit-mode" style="display:none;">
                                    <input class="form-control d-inline w-auto" name="anak_ke" value="{{ $user['anak_ke'] }}" style="width:60px;display:inline-block;">
                                    <span class="mx-2">dari</span>
                                    <input class="form-control d-inline w-auto" name="jumlah_saudara" value="{{ $user['jumlah_saudara'] }}" style="width:60px;display:inline-block;">
                                    <span>bersaudara</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Tinggal Bersama</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['tinggal_bersama'] }}</span>
                                <input class="form-control edit-mode" name="tinggal_bersama" value="{{ $user['tinggal_bersama'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Pendidikan Terakhir</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['pendidikan_terakhir'] }}</span>
                                <select class="form-control edit-mode" name="pendidikan_terakhir" style="display:none;">
                                    <option>MI/SD/Sederajat</option>
                                    <option>MTS/SMP/Sederajat</option>
                                    <option>SMA/MA/SMK/Sederajat</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Alamat Lengkap</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['alamat'] }}</span>
                                <div class="edit-mode" style="display:none;">
                                    <div class="form-group">
                                        <label>Negara</label> <select class="form-control select2" name="negara" id="negara" style="width: 100%;">
                                            <option value="">Pilih Negara</option>
                                            <option value="ID" selected>Indonesia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select class="form-control select2" name="provinsi" id="provinsi" style="width: 100%;">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kabupaten/Kota</label>
                                        <select class="form-control select2" name="kabupaten" id="kabupaten" style="width: 100%;" disabled>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control select2" name="kecamatan" id="kecamatan" style="width: 100%;" disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Detail Alamat</label>
                                        <textarea class="form-control" name="detail_alamat" rows="3" placeholder="Masukkan nama jalan, RT/RW, dll">{{ $user['alamat'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Nomor HP Aktif</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['no_hp'] }}</span>
                                <input class="form-control edit-mode" name="no_hp" value="{{ $user['no_hp'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Ukuran Seragam</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['ukuran_seragam'] }}</span>
                                <select class="form-control edit-mode" name="ukuran_seragam" style="display:none;">
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Golongan Darah</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['golongan_darah'] }}</span>
                                <select class="form-control edit-mode" name="golongan_darah" style="display:none;">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>AB</option>
                                    <option>O</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Hobi/Minat Khusus</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['hobi'] }}</span>
                                <input class="form-control edit-mode" name="hobi" value="{{ $user['hobi'] }}" style="display:none;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 font-weight-bold">Status Keluarga</div>
                            <div class="col-md-8">
                                <span class="view-mode">{{ $user['status_keluarga'] }}</span>
                                <select class="form-control edit-mode" name="status_keluarga" style="display:none;">
                                    <option>Lengkap</option>
                                    <option>Yatim</option>
                                    <option>Piatu</option>
                                    <option>Yatim Piatu</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0-rc
            </div>
        </footer>
    </div>
    <!-- ./wrapper --> <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script> <!-- Custom JS -->
    <script src="{{ asset('js/identitas.js') }}"></script>
</body>

</html>