@extends('layouts.app')

@section('title', 'Sambutan - Pondok Pesantren Darul Abror')

@section('content')
<div class="sambutan">
    <!-- Section Sambutan Pimpinan -->
    <section class="section-pimpinan py-5">
        <div class="container">
            <!-- <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <h1 class="fw-bold display-4 mb-3" style="color: var(--primary-color);">Sambutan Pimpinan</h1>
                    <p class="lead text-muted">Pengasuh Pondok Pesantren Darul Abror Purwokerto</p>
                </div>
            </div> -->
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center mb-4">
                    <div class="image-container">
                        <img src="{{ asset('assets/images/public/profil/abah.jpg') }}" alt="Pimpinan Pondok" class="fotoprofil" style="max-width: 300px;">
                        <div class="nama-pimpinan fw-bold">Abah Taufiqur Rohman</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container px-md-4">
                        <h5 class="text-muted mb-2 text-center">Pengasuh Pondok Pesantren Darul Abror Purwokerto</h5>
                        <h3 class="fw-bold mb-4 text-center">Assalamu'alaikum Wr. Wb.</h3>
                        <p class="mb-4">
                            Pondok Pesantren Darul Abror hadir sebagai lembaga pendidikan yang tidak hanya mengajarkan ilmu agama, tetapi juga membentuk karakter santri agar memiliki keberanian dalam menuntut ilmu. Kami senantiasa mengajak seluruh santri untuk menghilangkan rasa malu yang dapat menghambat proses belajar. Santri harus berani bertanya, aktif berdiskusi, dan tidak segan untuk menyampaikan pendapatnya, karena keberanian ini adalah bekal penting dalam memahami ajaran agama secara mendalam.
                        </p>
                        <p class="text-justify">
                            Di lingkungan pesantren ini, kami menanamkan nilai-nilai kedisiplinan dan tanggung jawab sebagai bagian dari pembinaan karakter. Melalui kegiatan harian, seperti mengikuti kajian, salat berjamaah, dan berbagai aktivitas pesantren, diharapkan santri dapat membiasakan diri untuk hidup teratur dan patuh pada aturan. Semua ini menjadi fondasi dalam membangun generasi yang berilmu, berakhlak mulia, serta siap menjadi teladan di tengah masyarakat.
                        </p>
                        <p>
                            Kami terus berupaya menciptakan suasana belajar yang mendorong santri untuk aktif, kritis, dan percaya diri. Metode pembelajaran di Pondok Pesantren Darul Abror dirancang untuk mendukung tujuan tersebut, melalui sorogan, bandongan, dan diskusi kelompok. Dengan bekal ilmu, akhlak, dan keberanian, kami berharap santri Darul Abror dapat menjadi pribadi yang bermanfaat bagi agama, bangsa, dan negara.
                        </p>
                        <p class="fw-semibold mt-4 text-end">Wassalamu'alaikum Wr. Wb.</p>
                        <!-- <p class="fw-semibold text-end">– Abah Taufiqur Rohman –</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sambutan Pimpinan -->
</div>
@endsection