#!/bin/bash

# Blade Syntax Validator Script
# Script ini membantu memverifikasi struktur @if/@endif dalam file Blade

echo "=== Blade Syntax Validator ==="
echo

if [ -z "$1" ]; then
    echo "Usage: $0 <blade-file-path>"
    echo "Example: $0 resources/views/admin/dokumen/show.blade.php"
    exit 1
fi

BLADE_FILE="$1"

if [ ! -f "$BLADE_FILE" ]; then
    echo "Error: File '$BLADE_FILE' tidak ditemukan!"
    exit 1
fi

echo "Checking: $BLADE_FILE"
echo

# Count directives
if_count=$(grep -c '@if(' "$BLADE_FILE")
elseif_count=$(grep -c '@elseif(' "$BLADE_FILE")
else_count=$(grep -c '@else' "$BLADE_FILE")
endif_count=$(grep -c '@endif' "$BLADE_FILE")
unless_count=$(grep -c '@unless(' "$BLADE_FILE")
endunless_count=$(grep -c '@endunless' "$BLADE_FILE")

echo "=== Directive Counts ==="
echo "@if:        $if_count"
echo "@elseif:    $elseif_count"  
echo "@else:      $else_count"
echo "@endif:     $endif_count"
echo "@unless:    $unless_count"
echo "@endunless: $endunless_count"
echo

# Check balance
total_opening=$((if_count + unless_count))
total_closing=$((endif_count + endunless_count))

echo "=== Balance Check ==="
echo "Total opening: $total_opening (@if + @unless)"
echo "Total closing: $total_closing (@endif + @endunless)"

if [ $total_opening -eq $total_closing ]; then
    echo "✅ Structure appears balanced!"
else
    echo "❌ UNBALANCED! Difference: $((total_opening - total_closing))"
    echo
    echo "=== Detailed Analysis ==="
    echo "Line numbers with @if:"
    grep -n '@if(' "$BLADE_FILE"
    echo
    echo "Line numbers with @endif:"
    grep -n '@endif' "$BLADE_FILE"
fi

echo
echo "=== Common Blade Patterns Check ==="

# Check for nested structures
echo "Checking for nested @if patterns..."
awk '/^[[:space:]]*@if/ { depth++; print NR ": " $0 " (depth: " depth ")" } /^[[:space:]]*@endif/ { print NR ": " $0 " (depth: " depth ")"; depth-- }' "$BLADE_FILE" | head -20

echo
echo "=== Potential Issues ==="

# Check for common issues
if grep -q '@if.*@if' "$BLADE_FILE"; then
    echo "⚠️  Warning: Multiple @if on same line detected"
    grep -n '@if.*@if' "$BLADE_FILE"
fi

if grep -q '@else.*@else' "$BLADE_FILE"; then
    echo "⚠️  Warning: Multiple @else on same line detected"
    grep -n '@else.*@else' "$BLADE_FILE"
fi

# Check for unclosed PHP blocks
if grep -q '@php' "$BLADE_FILE" && ! grep -q '@endphp' "$BLADE_FILE"; then
    echo "⚠️  Warning: @php without @endphp detected"
fi

echo
echo "=== Validation Complete ==="
