<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CetakpdfController extends Controller
{
    public function index()
    {
        return view('user.cetakpdf');
    }
}
