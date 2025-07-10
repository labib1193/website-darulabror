<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    // Test Cloudinary connection
    $cloudinary = new \Cloudinary\Cloudinary();
    echo "Cloudinary configured successfully!\n";

    // Test basic configuration
    $config = $cloudinary->configuration;
    echo "Cloud name: " . $config->cloud->cloudName . "\n";
    echo "API key exists: " . (!empty($config->cloud->apiKey) ? 'Yes' : 'No') . "\n";
    echo "API secret exists: " . (!empty($config->cloud->apiSecret) ? 'Yes' : 'No') . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
