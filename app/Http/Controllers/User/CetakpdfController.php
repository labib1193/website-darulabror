<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\User;

class CetakpdfController extends Controller
{
    /**
     * Show cetak PDF page
     */    public function index()
    {
        $userId = Auth::id();

        // Load user data with relationships
        $user = User::with(['identitas', 'dokumen', 'pembayaran'])->find($userId);

        return view('user.cetakpdf', compact('user'));
    }

    /**
     * Generate and download PDF
     */    public function generatePdf(Request $request)
    {
        $userId = Auth::id();

        // Load user data with relationships
        $user = User::with(['identitas', 'dokumen', 'pembayaran'])->find($userId);
        // Check if user has basic data
        if (!$user->identitas) {
            return back()->with('error', 'Anda harus melengkapi data identitas terlebih dahulu sebelum mencetak formulir pendaftaran.');
        }

        // Prepare data for PDF
        $data = [
            'user' => $user,
            'identitas' => $user->identitas,
            'registration_date' => $user->created_at,
            'print_date' => Carbon::now(),
        ];        // Generate PDF
        $pdf = Pdf::loadView('user.pdf.pendaftaran', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => true,
                'enable_font_subsetting' => true,
                'chroot' => public_path(),
                'isUnicodeEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'enable_php' => true,
                'enable_javascript' => false,
                'enable_html5_parser' => true,
            ]);

        // Download PDF with filename
        $filename = 'Formulir_Pendaftaran_' . str_replace([' ', '.', '@'], '_', $user->name) . '_' . date('YmdHis') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Preview PDF in browser
     */    public function previewPdf(Request $request)
    {
        $userId = Auth::id();

        // Load user data with relationships
        $user = User::with(['identitas', 'dokumen', 'pembayaran'])->find($userId);
        // Check if user has basic data
        if (!$user->identitas) {
            return back()->with('error', 'Anda harus melengkapi data identitas terlebih dahulu sebelum melihat preview formulir pendaftaran.');
        }

        // Prepare data for PDF
        $data = [
            'user' => $user,
            'identitas' => $user->identitas,
            'registration_date' => $user->created_at,
            'print_date' => Carbon::now(),
        ];        // Generate PDF and show in browser
        $pdf = Pdf::loadView('user.pdf.pendaftaran', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => true,
                'enable_font_subsetting' => true,
                'chroot' => public_path(),
                'isUnicodeEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'enable_php' => true,
                'enable_javascript' => false,
                'enable_html5_parser' => true,
            ]);

        return $pdf->stream('Preview_Formulir_Pendaftaran.pdf');
    }
}
