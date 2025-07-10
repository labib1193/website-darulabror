<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Log;

class EnsureDokumenUserExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if this is a dokumen route with dokumen parameter
        $dokumen = $request->route('dokumen');

        if ($dokumen instanceof Dokumen) {
            // Load user relationship if not already loaded
            if (!$dokumen->relationLoaded('user')) {
                $dokumen->load('user');
            }

            // Check if user exists
            if (!$dokumen->user) {
                Log::warning('Dokumen accessed but user is missing', [
                    'dokumen_id' => $dokumen->id,
                    'route' => $request->route()->getName(),
                    'user_id' => $dokumen->user_id
                ]);

                return redirect()->route('admin.dokumen.index')
                    ->with('error', 'Data user untuk dokumen ini tidak ditemukan atau sudah dihapus.');
            }
        }

        return $next($request);
    }
}
