<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('user.pengaturanakun');
    }
}
