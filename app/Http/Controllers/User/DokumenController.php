<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DokumenController extends Controller
{
    public function index()
    {
        return view('user.dokumen');
    }
}
