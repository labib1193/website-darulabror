<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class IdentitasController extends Controller
{
    public function index()
    {
        return view('user.identitas');
    }
}
