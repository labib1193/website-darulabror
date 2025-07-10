<?php

echo "=== Blade File Validation Report ===\n\n";

$file = 'resources/views/admin/dokumen/show.blade.php';
$content = file_get_contents($file);

// Count directives
$if_count = substr_count($content, '@if(');
$endif_count = substr_count($content, '@endif');
$else_count = substr_count($content, '@else');
$elseif_count = substr_count($content, '@elseif(');

echo "File: $file\n";
echo "Size: " . filesize($file) . " bytes\n\n";

echo "=== Directive Counts ===\n";
echo "@if:        $if_count\n";
echo "@elseif:    $elseif_count\n";
echo "@else:      $else_count\n";
echo "@endif:     $endif_count\n\n";

echo "=== Balance Check ===\n";
if ($if_count === $endif_count) {
    echo "✅ SUCCESS: @if and @endif are balanced ($if_count each)\n";
} else {
    echo "❌ ERROR: @if ($if_count) and @endif ($endif_count) are not balanced\n";
}

// Check for common issues
$lines = explode("\n", $content);
$issues = [];

foreach ($lines as $lineNum => $line) {
    $lineNum++; // Make 1-based

    // Check for potential issues
    if (strpos($line, '@if(') !== false && strpos($line, ')') === false) {
        $issues[] = "Line $lineNum: Incomplete @if statement";
    }

    if (preg_match('/@if\s*\(\s*\)/', $line)) {
        $issues[] = "Line $lineNum: Empty @if condition";
    }
}

if (empty($issues)) {
    echo "✅ No syntax issues detected\n";
} else {
    echo "⚠️  Potential issues found:\n";
    foreach ($issues as $issue) {
        echo "   - $issue\n";
    }
}

echo "\n=== Summary ===\n";
echo "Blade file validation: " . ($if_count === $endif_count && empty($issues) ? "PASSED" : "FAILED") . "\n";
echo "Ready for deployment: " . ($if_count === $endif_count && empty($issues) ? "YES" : "NO") . "\n";
