<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|max:1000',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan maksimal 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Contact::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'pesan' => $request->pesan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda telah berhasil dikirim. Terima kasih atas kritik dan saran yang diberikan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
            ], 500);
        }
    }
}
