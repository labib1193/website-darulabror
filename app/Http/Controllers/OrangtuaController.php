<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orangtuaList = Orangtua::where('user_id', Auth::id())->get();
        return view('user.orangtua', compact('orangtuaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.orangtua');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_kk' => 'required|string|max:20',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'no_hp_1' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'penghasilan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'required|in:Ayah,Ibu,Kakak,Adik,Paman,Bibi,Kakek,Nenek,Sepupu,Wali',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $orangtua = Orangtua::create([
            'user_id' => Auth::id(),
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'no_hp_1' => $request->no_hp_1,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan' => $request->penghasilan,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data orangtua berhasil disimpan.',
            'data' => $orangtua
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orangtua = Orangtua::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($orangtua);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $orangtua)
    {
        $orangtuaData = Orangtua::where('user_id', Auth::id())->findOrFail($orangtua);
        return response()->json($orangtuaData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $orangtua)
    {
        $validator = Validator::make($request->all(), [
            'no_kk' => 'required|string|max:20',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'no_hp_1' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'penghasilan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'required|in:Ayah,Ibu,Kakak,Adik,Paman,Bibi,Kakek,Nenek,Sepupu,Wali',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $orangtuaData = Orangtua::where('user_id', Auth::id())->findOrFail($orangtua);

        $orangtuaData->update([
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'no_hp_1' => $request->no_hp_1,
            'pekerjaan' => $request->pekerjaan,
            'penghasilan' => $request->penghasilan,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kode_pos' => $request->kode_pos,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data orangtua berhasil diperbarui.',
            'data' => $orangtuaData
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $orangtua)
    {
        $orangtuaData = Orangtua::where('user_id', Auth::id())->findOrFail($orangtua);
        $orangtuaData->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data orangtua berhasil dihapus.'
        ]);
    }
}
