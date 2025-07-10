<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class VerifyCloudinaryConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudinary:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify Cloudinary configuration and test connection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Verifying Cloudinary configuration...');
        $this->newLine();

        // Check environment variables
        $this->checkEnvironmentVariables();

        // Test connection
        $this->testConnection();

        $this->newLine();
        $this->info('Verification complete!');
    }

    /**
     * Check if Cloudinary environment variables are set
     */
    private function checkEnvironmentVariables(): void
    {
        $this->info('Checking environment variables...');

        $cloudUrl = env('CLOUDINARY_URL');
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_KEY');
        $apiSecret = env('CLOUDINARY_SECRET');

        if (!empty($cloudUrl)) {
            $this->line('✓ CLOUDINARY_URL is set');
            // Parse the URL to show components
            $parsed = parse_url($cloudUrl);
            if (isset($parsed['host'])) {
                $this->line("  Cloud Name: {$parsed['host']}");
            }
        } else {
            $this->error('✗ CLOUDINARY_URL is not set');
        }

        if (!empty($cloudName)) {
            $this->line("✓ CLOUDINARY_CLOUD_NAME is set: {$cloudName}");
        } else {
            $this->error('✗ CLOUDINARY_CLOUD_NAME is not set');
        }

        if (!empty($apiKey)) {
            $this->line("✓ CLOUDINARY_KEY is set: " . substr($apiKey, 0, 8) . '...');
        } else {
            $this->error('✗ CLOUDINARY_KEY is not set');
        }

        if (!empty($apiSecret)) {
            $this->line("✓ CLOUDINARY_SECRET is set: " . substr($apiSecret, 0, 8) . '...');
        } else {
            $this->error('✗ CLOUDINARY_SECRET is not set');
        }

        // Check if we have valid configuration
        $hasValidConfig = (!empty($cloudUrl)) || (!empty($cloudName) && !empty($apiKey) && !empty($apiSecret));

        if (!$hasValidConfig) {
            $this->error('Configuration incomplete! You need either:');
            $this->error('  1. CLOUDINARY_URL, or');
            $this->error('  2. CLOUDINARY_CLOUD_NAME + CLOUDINARY_KEY + CLOUDINARY_SECRET');
            $this->newLine();
            $this->info('Please check CLOUDINARY_SETUP.md for setup instructions.');
        }

        $this->newLine();
    }

    /**
     * Test Cloudinary connection
     */
    private function testConnection(): void
    {
        $this->info('Testing Cloudinary connection...');

        try {
            // Try to get Cloudinary instance
            $cloudinary = null;

            try {
                $cloudinary = Cloudinary::getCloudinary();
                $this->line('✓ Cloudinary instance created successfully');
            } catch (\Exception $e) {
                $this->warn('! Failed to get Cloudinary from config, trying direct instantiation...');

                // Try direct instantiation
                $cloudUrl = env('CLOUDINARY_URL');
                if ($cloudUrl) {
                    $cloudinary = new \Cloudinary\Cloudinary($cloudUrl);
                } else {
                    $cloudinary = new \Cloudinary\Cloudinary([
                        'cloud' => [
                            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                            'api_key' => env('CLOUDINARY_KEY'),
                            'api_secret' => env('CLOUDINARY_SECRET')
                        ]
                    ]);
                }
                $this->line('✓ Cloudinary instance created via direct instantiation');
            }

            if (!$cloudinary) {
                throw new \Exception('Failed to create Cloudinary instance');
            }

            // Test API call - get usage info
            $usage = $cloudinary->adminApi()->usage();

            if (isset($usage['credits']['usage'])) {
                $this->line('✓ API connection successful');
                $this->line("  Credits used: {$usage['credits']['usage']} / {$usage['credits']['limit']}");
                $this->line("  Storage used: " . round($usage['storage']['usage'] / 1048576, 2) . " MB");
                $this->line("  Bandwidth used: " . round($usage['bandwidth']['usage'] / 1048576, 2) . " MB");
            } else {
                $this->line('✓ API connection successful (limited usage info)');
            }
        } catch (\Exception $e) {
            $this->error('✗ Connection test failed: ' . $e->getMessage());
            $this->newLine();
            $this->error('Common issues:');
            $this->error('  • Invalid credentials');
            $this->error('  • Network connectivity problems');
            $this->error('  • Cloudinary service unavailable');
            $this->newLine();
            $this->info('Please check:');
            $this->info('  1. Your credentials in .env file');
            $this->info('  2. Internet connection');
            $this->info('  3. Cloudinary dashboard for account status');
        }

        $this->newLine();
    }
}
