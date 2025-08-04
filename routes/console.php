<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\VerifyCloudinaryConfig;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Register Cloudinary verification command
Artisan::command('cloudinary:verify', function () {
    $this->into('Verifikasi Cloudinary dijalankan');
})->purpose('Verify Cloudinary configuration and test connection');
