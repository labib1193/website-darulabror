<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DokumenTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_file_url_with_cloudinary_url(): void
    {
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'user_id' => $user->id,
            'foto_ktp' => 'https://res.cloudinary.com/test/image/upload/v123456789/dokumen/foto_ktp.jpg',
            'status_verifikasi' => 'pending'
        ]);

        $url = $dokumen->getFileUrl('foto_ktp');

        $this->assertEquals('https://res.cloudinary.com/test/image/upload/v123456789/dokumen/foto_ktp.jpg', $url);
    }

    public function test_get_file_url_with_null_value(): void
    {
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'user_id' => $user->id,
            'foto_ktp' => null,
            'status_verifikasi' => 'pending'
        ]);

        $url = $dokumen->getFileUrl('foto_ktp');

        $this->assertNull($url);
    }

    public function test_get_completion_percentage(): void
    {
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'user_id' => $user->id,
            'foto_ktp' => 'https://res.cloudinary.com/test/image/upload/v123456789/dokumen/foto_ktp.jpg',
            'foto_kk' => 'https://res.cloudinary.com/test/image/upload/v123456789/dokumen/foto_kk.jpg',
            'status_verifikasi' => 'pending'
        ]);

        $percentage = $dokumen->getCompletionPercentage();

        // 2 out of 5 files = 40%
        $this->assertEquals(40, $percentage);
    }

    public function test_get_formatted_file_size(): void
    {
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'user_id' => $user->id,
            'foto_ktp' => 'https://res.cloudinary.com/test/image/upload/v123456789/dokumen/foto_ktp.jpg',
            'foto_ktp_size' => 1048576, // 1 MB
            'status_verifikasi' => 'pending'
        ]);

        $size = $dokumen->getFormattedFileSize('foto_ktp');

        $this->assertEquals('1.00 MB', $size);
    }

    public function test_get_formatted_file_size_with_null(): void
    {
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'user_id' => $user->id,
            'foto_ktp' => null,
            'foto_ktp_size' => null,
            'status_verifikasi' => 'pending'
        ]);

        $size = $dokumen->getFormattedFileSize('foto_ktp');

        $this->assertEquals('-', $size);
    }
}
