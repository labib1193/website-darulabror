@extends('layouts.app')

@section('title', $berita['judul'] . ' - Pondok Pesantren Darul Abror')

@section('content')
<div class="berita-detail">
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $berita['judul'] }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <article class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="article-content">
                        <!-- Article Header -->
                        <header class="mb-4">
                            <span class="badge {{ $berita['kategori_class'] }} mb-3">{{ $berita['kategori'] }}</span>
                            <h1 class="article-title fw-bold mb-3">{{ $berita['judul'] }}</h1>

                            <!-- Article Meta -->
                            <div class="article-meta d-flex flex-wrap align-items-center text-muted mb-4">
                                <div class="me-4">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $berita['tanggal'] }}
                                </div>
                                <div class="me-4">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $berita['waktu_baca'] }}
                                </div>
                                <div class="me-4">
                                    <i class="fas fa-user me-1"></i>
                                    {{ $berita['penulis'] }}
                                </div>
                            </div>
                        </header>

                        <!-- Featured Image -->
                        <div class="featured-image mb-4">
                            <img src="{{ asset($berita['gambar']) }}"
                                alt="{{ $berita['judul'] }}"
                                class="img-fluid rounded shadow-sm w-100">
                        </div>

                        <!-- Article Body -->
                        <div class="article-body">
                            <!-- Lead Paragraph -->
                            <p class="lead text-muted mb-4">{{ $berita['ringkasan'] }}</p>

                            <!-- Content Paragraphs -->
                            @foreach($berita['konten'] as $paragraf)
                            <p class="mb-4" style="text-align: justify; line-height: 1.8;">{{ $paragraf }}</p>
                            @endforeach
                        </div>

                        <!-- Tags -->
                        <div class="article-tags mt-5 pt-4 border-top">
                            <h6 class="fw-bold mb-3">Tags:</h6>
                            <div class="tags-list">
                                @foreach($berita['tags'] as $tag)
                                <span class="badge bg-light text-dark me-2 mb-2">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="social-share mt-4 pt-4 border-top">
                            <h6 class="fw-bold mb-3">Bagikan Artikel:</h6>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank" class="btn btn-primary btn-sm me-2">
                                    <i class="fab fa-facebook-f me-1"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita['judul']) }}"
                                    target="_blank" class="btn btn-info btn-sm me-2">
                                    <i class="fab fa-twitter me-1"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita['judul'] . ' - ' . request()->url()) }}"
                                    target="_blank" class="btn btn-success btn-sm me-2">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="copyLink()">
                                    <i class="fas fa-link me-1"></i> Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <!-- Berita Terkait -->
                        <div class="widget mb-5">
                            <h5 class="widget-title fw-bold mb-4">Berita Terkait</h5>
                            @foreach($beritaTerkait as $terkait)
                            <div class="related-post d-flex mb-3">
                                <div class="related-image me-3">
                                    <img src="{{ asset($terkait['gambar']) }}"
                                        alt="{{ $terkait['judul'] }}"
                                        class="img-fluid rounded"
                                        style="width: 80px; height: 60px; object-fit: cover;">
                                </div>
                                <div class="related-content flex-grow-1">
                                    <span class="badge {{ $terkait['kategori_class'] }} mb-1" style="font-size: 10px;">{{ $terkait['kategori'] }}</span>
                                    <h6 class="related-title mb-1">
                                        <a href="{{ route('berita.detail', $terkait['slug']) }}" class="text-decoration-none text-dark">
                                            {{ Str::limit($terkait['judul'], 60) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $terkait['tanggal'] }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Newsletter Subscribe -->
                        <div class="widget newsletter-widget bg-primary text-white p-4 rounded">
                            <h5 class="widget-title fw-bold mb-3">Berlangganan Newsletter</h5>
                            <p class="mb-3">Dapatkan berita terbaru dari Pondok Pesantren Darul Abror langsung di email Anda.</p>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Anda" required>
                                </div>
                                <button type="submit" class="btn btn-light fw-bold w-100">Berlangganan</button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </article>

    <!-- Navigation to Other Articles -->
    <section class="article-navigation py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('berita') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Berita
                    </a>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('berita') }}" class="btn btn-primary">
                        Lihat Berita Lainnya <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    function copyLink() {
        const url = window.location.href;

        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(function() {
                alert('Link berhasil disalin!');
            });
        } else {
            // Fallback untuk browser lama
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Link berhasil disalin!');
        }
    }
</script>
@endpush
@endsection