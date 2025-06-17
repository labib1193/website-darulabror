<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Orangtua;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrangtuaStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_orangtua_with_new_status_options()
    {
        $user = User::factory()->create();

        $statusOptions = [
            'Ayah',
            'Ibu',
            'Kakak',
            'Adik',
            'Paman',
            'Bibi',
            'Kakek',
            'Nenek',
            'Sepupu',
            'Wali'
        ];

        foreach ($statusOptions as $status) {
            $response = $this->actingAs($user)->postJson('/orangtua', [
                'no_kk' => '1234567890123456',
                'nik' => '1234567890123456',
                'nama_lengkap' => 'Test ' . $status,
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Test City',
                'tanggal_lahir' => '1980-01-01',
                'no_hp_1' => '081234567890',
                'status' => $status,
            ]);

            $response->assertStatus(200)
                ->assertJson(['success' => true]);
        }

        $this->assertEquals(count($statusOptions), Orangtua::count());
    }

    public function test_cannot_create_orangtua_with_old_status()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/orangtua', [
            'no_kk' => '1234567890123456',
            'nik' => '1234567890123456',
            'nama_lengkap' => 'Test Orangtua',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Test City',
            'tanggal_lahir' => '1980-01-01',
            'no_hp_1' => '081234567890',
            'status' => 'Orangtua', // Old status should fail
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['status']);
    }
}
