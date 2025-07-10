<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/debug/cloudinary', function () {
    // Only allow this in development or with proper authorization
    if (app()->environment('production')) {
        return response()->json(['error' => 'Not allowed in production'], 403);
    }

    try {
        $config = [
            'cloud_url' => config('cloudinary.cloud_url'),
            'notification_url' => config('cloudinary.notification_url'),
            'upload_preset' => config('cloudinary.upload_preset'),
            'upload_route' => config('cloudinary.upload_route'),
            'upload_action' => config('cloudinary.upload_action'),
        ];

        // Test Cloudinary initialization
        $cloudinary = new \Cloudinary\Cloudinary();
        $cloudinaryConfig = $cloudinary->configuration;

        return response()->json([
            'status' => 'success',
            'config' => $config,
            'cloudinary_config' => [
                'cloud_name' => $cloudinaryConfig->cloud->cloudName ?? 'not set',
                'api_key' => $cloudinaryConfig->cloud->apiKey ? 'set' : 'not set',
                'api_secret' => $cloudinaryConfig->cloud->apiSecret ? 'set' : 'not set',
            ],
            'env_vars' => [
                'CLOUDINARY_CLOUD_NAME' => env('CLOUDINARY_CLOUD_NAME') ? 'set' : 'not set',
                'CLOUDINARY_API_KEY' => env('CLOUDINARY_API_KEY') ? 'set' : 'not set',
                'CLOUDINARY_API_SECRET' => env('CLOUDINARY_API_SECRET') ? 'set' : 'not set',
                'CLOUDINARY_URL' => env('CLOUDINARY_URL') ? 'set' : 'not set',
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

Route::post('/debug/cloudinary/test-upload', function (Request $request) {
    // Only allow this in development or with proper authorization
    if (app()->environment('production')) {
        return response()->json(['error' => 'Not allowed in production'], 403);
    }

    try {
        // Create a simple test file
        $testContent = 'This is a test file for Cloudinary upload';
        $tempFile = tempnam(sys_get_temp_dir(), 'cloudinary_test');
        file_put_contents($tempFile, $testContent);

        $cloudinary = new \Cloudinary\Cloudinary();
        $uploadResult = $cloudinary->uploadApi()->upload($tempFile, [
            'public_id' => 'test_upload_' . time(),
            'folder' => 'test',
            'resource_type' => 'raw'
        ]);

        // Clean up temp file
        unlink($tempFile);

        return response()->json([
            'status' => 'success',
            'upload_result' => $uploadResult,
            'secure_url' => $uploadResult['secure_url']
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
