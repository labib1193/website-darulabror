<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCloudinary extends Command
{
    protected $signature = 'cloudinary:test';
    protected $description = 'Test Cloudinary configuration and upload functionality';

    public function handle()
    {
        $this->info('Testing Cloudinary configuration...');

        // Check environment variables
        $this->info('Checking environment variables:');
        $envVars = [
            'CLOUDINARY_CLOUD_NAME' => env('CLOUDINARY_CLOUD_NAME'),
            'CLOUDINARY_API_KEY' => env('CLOUDINARY_API_KEY'),
            'CLOUDINARY_API_SECRET' => env('CLOUDINARY_API_SECRET'),
            'CLOUDINARY_URL' => env('CLOUDINARY_URL'),
        ];

        foreach ($envVars as $key => $value) {
            if ($value) {
                $this->info("✓ {$key}: Set");
            } else {
                $this->error("✗ {$key}: Not set");
            }
        }

        // Check config
        $this->info('Checking config:');
        $config = config('cloudinary');
        if ($config && isset($config['cloud_url'])) {
            $this->info("✓ Cloudinary config loaded");
            $this->info("Cloud URL: " . substr($config['cloud_url'], 0, 30) . "...");
        } else {
            $this->error("✗ Cloudinary config not loaded");
            return 1;
        }

        // Test Cloudinary initialization
        try {
            $cloudinary = new \Cloudinary\Cloudinary();
            $this->info("✓ Cloudinary instance created successfully");

            $cloudinaryConfig = $cloudinary->configuration;
            $this->info("Cloud name: " . ($cloudinaryConfig->cloud->cloudName ?? 'not set'));
            $this->info("API key: " . ($cloudinaryConfig->cloud->apiKey ? 'set' : 'not set'));
            $this->info("API secret: " . ($cloudinaryConfig->cloud->apiSecret ? 'set' : 'not set'));
        } catch (\Exception $e) {
            $this->error("✗ Failed to create Cloudinary instance: " . $e->getMessage());
            return 1;
        }

        // Test upload
        $this->info('Testing upload...');
        try {
            // Create a simple test file
            $testContent = 'Test file created at ' . now();
            $tempFile = tempnam(sys_get_temp_dir(), 'cloudinary_test');
            file_put_contents($tempFile, $testContent);

            $uploadResult = $cloudinary->uploadApi()->upload($tempFile, [
                'public_id' => 'test_upload_' . time(),
                'folder' => 'test',
                'resource_type' => 'raw'
            ]);

            // Clean up temp file
            unlink($tempFile);

            $this->info("✓ Upload successful!");
            $this->info("Public ID: " . $uploadResult['public_id']);
            $this->info("Secure URL: " . $uploadResult['secure_url']);

            // Try to delete the test file
            try {
                $cloudinary->uploadApi()->destroy($uploadResult['public_id'], ['resource_type' => 'raw']);
                $this->info("✓ Test file cleaned up");
            } catch (\Exception $e) {
                $this->warn("Warning: Could not clean up test file: " . $e->getMessage());
            }
        } catch (\Exception $e) {
            $this->error("✗ Upload failed: " . $e->getMessage());
            $this->error("Error details: " . $e->getTraceAsString());
            return 1;
        }

        $this->info('All tests passed! Cloudinary is properly configured.');
        return 0;
    }
}
