@extends('layouts.user')

@section('title', 'Test Fixed Sidebar - Dashboard Santri')
@section('page-title', 'Test Fixed Sidebar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Test Sidebar Fixed Position</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> Test Fixed Sidebar</h5>
                    <p>Halaman ini digunakan untuk menguji apakah sidebar tetap berada pada posisinya saat scroll ke bawah.</p>
                    <p>Scroll ke bawah untuk melihat efek fixed sidebar.</p>
                </div>

                <!-- Content untuk test scroll -->
                @for($i = 1; $i <= 20; $i++)
                    <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Section {{ $i }}</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                75% Complete
                            </div>
                        </div>
                    </div>
            </div>
            @endfor

            <div class="alert alert-success">
                <h5><i class="fas fa-check-circle"></i> Test Completed</h5>
                <p>Jika Anda sudah scroll sampai sini dan sidebar masih terlihat di sebelah kiri tanpa bergerak, berarti fixed sidebar berhasil!</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('styles')
<style>
    /* Additional test styles */
    .test-scroll-indicator {
        position: fixed;
        top: 50%;
        right: 20px;
        background: #007bff;
        color: white;
        padding: 10px;
        border-radius: 5px;
        z-index: 1000;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Add scroll indicator
        $('body').append('<div class="test-scroll-indicator">Scroll: <span id="scroll-position">0</span>px</div>');

        // Update scroll position
        $(window).scroll(function() {
            $('#scroll-position').text($(window).scrollTop());
        });

        // Test sidebar functionality
        console.log('Fixed Sidebar Test:');
        console.log('- Body classes:', $('body').attr('class'));
        console.log('- Sidebar classes:', $('.main-sidebar').attr('class'));
        console.log('- Content wrapper classes:', $('.content-wrapper').attr('class'));
    });
</script>
@endpush