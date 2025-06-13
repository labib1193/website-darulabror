@extends('layouts.app')

@section('title', 'Profil - Pondok Pesantren Darul Abror')

@section('content')
<div class="profil">
    <!-- Section Sambutan Pimpinan -->
    <section class="section-pimpinan py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center mb-4">
                    <div class="image-container">
                        <img src="{{ asset('images/ust.png') }}" alt="Pimpinan Pondok" class="img-fluid rounded shadow mb-3" style="max-width: 300px;">
                        <div class="nama-pimpinan fw-bold">H. Arif Hizbullah, MA</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container px-md-4">
                        <h5 class="text-muted mb-2 text-center">☆ Pimpinan Pondok Pesantren ☆</h5>
                        <h3 class="fw-bold mb-4 text-center">Assalamu'alaikum Wr. Wb.</h3>
                        <p class="mb-4">
                            Dalam menghadapi era globalisasi diperlukan generasi beriman dan berwawasan IPTEK, sehingga mereka dapat menjadi KHAIRU UMMAH (Ummat yang Terbaik) dan DZURRIYATAN THAYYIBAH (Keturunan yang Berkualitas). Mereka dapat memakmurkan dunia ini secara maksimal dalam naungan dan ridha Allah SWT untuk meraih BALDATUN THAYYIBATUN WA RABBUN GHAFUR (Negeri yang Makmur dan Mendapat Ampunan Allah SWT).
                        </p>
                        <p class="text-justify">
                            Dalam mencapai maksud tersebut dan dengan dorongan rasa tanggung jawab, maka Yayasan Shuffah Hizbullah (Al Fatah) ikut berpartisipasi dalam pembenahan dan peningkatan kualitas dengan sistem pendidikan terpadu antara Kurikulum Nasional dan Kurikulum Pesantren.
                        </p>
                        <p class="fw-semibold mt-4 text-end">– H. Arif Hizbullah, MA –</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sambutan Pimpinan -->

    <!-- Section Visi Misi -->
    <section class="visi-misi-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="visi-misi-card p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Visi</h4>
                        <p class="text-muted">Mewujudkan generasi muslim yang bertaqwa, berilmu, terampil dan berakhlak mulia</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="visi-misi-card p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Misi</h4>
                        <ul class="text-muted">
                            <li>Menyelenggarakan pendidikan yang berkualitas dalam pencapaian prestasi akademik dan non akademik</li>
                            <li>Mewujudkan pembelajaran dan pembiasaan dalam mempelajari Al-Qur'an dan menjalankan ajaran agama Islam</li>
                            <li>Mewujudkan pembentukan karakter Islami yang mampu mengaktualisasikan diri dalam masyarakat</li>
                            <li>Meningkatkan pengetahuan dan profesionalisme tenaga kependidikan sesuai dengan perkembangan dunia pendidikan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Visi Misi -->

    <!-- Section Sejarah -->
    <section class="timeline-section py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Sejarah Pondok Pesantren</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1990</div>
                        <p>Pendirian awal Pondok Pesantren Darul Abror oleh para ulama dan tokoh masyarakat.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1995</div>
                        <p>Pembangunan masjid pertama dan perluasan area pondok.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2000</div>
                        <p>Pengembangan program pendidikan dengan penambahan Madrasah Diniyah.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2010</div>
                        <p>Modernisasi fasilitas dan pengembangan program tahfidz.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2020</div>
                        <p>Pengembangan program pendidikan modern dan fasilitas teknologi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sejarah -->
</div>
@endsection