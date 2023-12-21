<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tdbController extends Controller
{
    public function index()
    {
        return view('correcteur');
    }
}
