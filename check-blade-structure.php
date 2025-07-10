<?php

$file = 'resources/views/admin/dokumen/show.blade.php';
$content = file_get_contents($file);
$lines = explode("\n", $content);

$stack = [];
$errors = [];

foreach ($lines as $lineNum => $line) {
    $lineNum++; // Make it 1-based
    $trimmed = trim($line);

    // Check for @if, @elseif, @else, @endif
    if (preg_match('/@if\s*\(/', $trimmed)) {
        $stack[] = ['type' => 'if', 'line' => $lineNum, 'content' => $trimmed];
        echo "Line $lineNum: PUSH IF - $trimmed\n";
    } elseif (preg_match('/@elseif\s*\(/', $trimmed)) {
        echo "Line $lineNum: ELSEIF - $trimmed\n";
    } elseif (preg_match('/@else\s*$/', $trimmed)) {
        echo "Line $lineNum: ELSE - $trimmed\n";
    } elseif (preg_match('/@endif\s*$/', $trimmed)) {
        if (empty($stack)) {
            $errors[] = "Line $lineNum: @endif without matching @if";
        } else {
            $popped = array_pop($stack);
            echo "Line $lineNum: POP ENDIF - matches IF from line {$popped['line']}\n";
        }
    }
}

if (!empty($stack)) {
    echo "\nERRORS: Unmatched @if statements:\n";
    foreach ($stack as $item) {
        echo "Line {$item['line']}: {$item['content']}\n";
    }
}

if (!empty($errors)) {
    echo "\nERRORS: Extra @endif statements:\n";
    foreach ($errors as $error) {
        echo "$error\n";
    }
}

if (empty($stack) && empty($errors)) {
    echo "\nAll @if/@endif pairs are properly matched!\n";
}
