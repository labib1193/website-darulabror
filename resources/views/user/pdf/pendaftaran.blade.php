<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Santri - Pondok Pesantren Darul Abror</title>
    <style>
        @page {
            margin: 15mm;
            margin-top: 10mm;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .header-content {
            display: table;
            width: 100%;
        }

        .logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }

        .logo img {
            width: 70px;
            height: auto;
            max-width: 70px;
            display: block;
        }

        .logo-fallback {
            width: 70px;
            height: 70px;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .title-section {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .main-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #000;
            letter-spacing: 1px;
        }

        .arabic-title {
            font-family: 'DejaVu Sans', 'Arial Unicode MS', sans-serif;
            font-size: 16px;
            margin: 5px 0;
            color: #000;
            direction: rtl;
            unicode-bidi: embed;
            font-weight: bold;
            text-align: center;
        }

        .sub-title {
            font-size: 11px;
            margin: 3px 0;
            color: #666;
        }

        .address {
            font-size: 10px;
            margin: 5px 0 0 0;
            color: #666;
        }

        .form-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0 10px 0;
            color: #000;
            text-decoration: underline;
        }

        .content {
            margin: 10px 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        .data-table td {
            padding: 4px 6px;
            border: 1px solid #ddd;
            vertical-align: top;
            font-size: 12px;
        }

        .data-table td.label {
            background-color: #f8f9fa;
            font-weight: normal;
            width: 30%;
        }

        .data-table td.value {
            width: 70%;
            font-weight: normal;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 40px 0 6px 0;
            color: #000;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }

        .note {
            margin-top: 20px;
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .note-title {
            font-weight: bold;
            margin-bottom: 3px;
            color: #000;
            font-size: 10px;
        }

        .note-text {
            font-size: 8px;
            line-height: 1.2;
            color: #666;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 3px;
        }

        .signature-section {
            margin-top: 20px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            padding: 15px 10px;
            text-align: center;
            vertical-align: top;
            width: 50%;
            font-size: 10px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 5px;
        }

        .status-badge {
            padding: 2px 5px;
            border-radius: 2px;
            font-size: 10px;
            font-weight: normal;
        }

        .status-verified {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body> <!-- Header with Logo and Title -->
    <div class="header">
        <div class="header-content">
            <div class="logo">
                @if(file_exists(public_path('assets/images/global/logokopsurat.png')))
                <img src="{{ public_path('assets/images/global/logokopsurat.png') }}" alt="Logo Darul Abror" style="width: 70px; height: auto;">
                @else
                <div class="logo-fallback">
                    LOGO<br>DARUL<br>ABROR
                </div>
                @endif
            </div>
            <div class="title-section">
                <div class="main-title">PONDOK PESANTREN DARUL ABROR</div>
                <div class="arabic-title">معهد دار الأبرار الإسلامي للتربية والعلوم</div>
                <div class="sub-title">DARUL ABROR ISLAMIC INSTITUTE FOR EDUCATION AND SCIENCE</div>
                <div class="address">WATUMAS PURWOKERTO TELP: (0335) 774121 / 081333345629</div>
            </div>
        </div>
    </div>

    <!-- Form Title -->
    <div class="form-title">FORMULIR PENDAFTARAN SANTRI</div>

    <!-- Content -->
    <div class="content">
        <!-- Data Identitas -->
        <div class="section-title">DATA IDENTITAS SANTRI</div>
        <table class="data-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">{{ $user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="value">
                    @if($identitas && $identitas->jenis_kelamin)
                    {{ $identitas->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    @else
                    -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td class="value">
                    @if($identitas && $identitas->tempat_lahir && $identitas->tanggal_lahir)
                    {{ $identitas->tempat_lahir }}, {{ \Carbon\Carbon::parse($identitas->tanggal_lahir)->format('d F Y') }}
                    @else
                    -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="value">
                    @if($identitas)
                    @php
                    $alamatLengkap = [];
                    // Tambahkan alamat utama
                    if (!empty($identitas->alamat_lengkap)) {
                    $alamatLengkap[] = $identitas->alamat_lengkap;
                    }

                    // Tambahkan desa/kelurahan
                    if (!empty($identitas->desa)) {
                    $alamatLengkap[] = 'Desa ' . $identitas->desa;
                    }

                    // Tambahkan kecamatan
                    if (!empty($identitas->kecamatan)) {
                    $alamatLengkap[] = 'Kec. ' . $identitas->kecamatan;
                    }

                    // Tambahkan kabupaten
                    if (!empty($identitas->kabupaten)) {
                    $alamatLengkap[] = 'Kab. ' . $identitas->kabupaten;
                    }

                    // Tambahkan provinsi
                    if (!empty($identitas->provinsi)) {
                    $alamatLengkap[] = $identitas->provinsi;
                    }

                    // Tambahkan kode pos
                    if (!empty($identitas->kode_pos)) {
                    $alamatLengkap[] = $identitas->kode_pos;
                    }

                    // Gabungkan dengan koma dan spasi
                    $fullAddress = implode(', ', $alamatLengkap);
                    @endphp
                    {{ $fullAddress ?: '-' }}
                    @else
                    -
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Nomor Telepon/HP</td>
                <td class="value">{{ $identitas->no_hp ?? '-' }}</td>
            </tr>
        </table>

        <!-- Status Dokumen -->
        <div class="section-title">STATUS KELENGKAPAN DOKUMEN</div>
        <table class="data-table">
            <tr>
                <td class="label">Data Identitas</td>
                <td class="value">
                    @if($identitas)
                    <span class="status-badge status-verified">Lengkap</span>
                    @else
                    <span class="status-badge status-rejected">Belum Lengkap</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Dokumen Pendukung</td>
                <td class="value">
                    @if($user->dokumen)
                    <span class="status-badge status-verified">Lengkap</span>
                    @else
                    <span class="status-badge status-rejected">Belum Upload</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Pembayaran</td>
                <td class="value"> @if($user->pembayaran && $user->pembayaran->where('status_verifikasi', 'approved')->count() > 0)
                    <span class="status-badge status-verified">Lunas</span>
                    @else
                    <span class="status-badge status-pending">Belum Lunas</span>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Catatan -->
        <div class="note">
            <div class="note-title">CATATAN PENTING:</div>
            <div class="note-text">
                Tunjukkan formulir ini (bisa dicetak atau tetap berupa digital) kepada panitia pendaftaran untuk keperluan verifikasi berkas.
                Pastikan semua data yang tertera sudah benar dan lengkap. Jika terdapat kesalahan data, silakan hubungi panitia pendaftaran
                atau lakukan perbaikan melalui sistem online.
            </div>
        </div> <!-- Signature Section -->
        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td>
                        <div style="font-size: 9px;">Purwokerto, {{ $print_date ? $print_date->format('d F Y') : date('d F Y') }}</div>
                        <div style="margin-top: 5px; margin-bottom: 5px; font-size: 9px;">Calon Santri,</div>
                        <div class="signature-line"></div>
                        <div style="font-weight: bold; font-size: 9px;">{{ $user->name ?? '' }}</div>
                    </td>
                    <td>
                        <div style="font-size: 9px;">Mengetahui,</div>
                        <div style="margin-top: 5px; margin-bottom: 5px; font-size: 9px;">Panitia Pendaftaran</div>
                        <div class="signature-line"></div>
                        <div style="font-weight: bold; font-size: 9px;">(__________________)</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen ini dicetak secara otomatis dari Sistem Pendaftaran Online Pondok Pesantren Darul Abror<br>
        Tanggal cetak: {{ $print_date ? $print_date->format('d F Y H:i:s') : date('d F Y H:i:s') }} WIB
    </div>
</body>

</html>