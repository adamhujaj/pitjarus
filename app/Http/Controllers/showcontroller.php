<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class showcontroller extends Controller
{
    public function index()
    {
        
        return view('show');
    }
}
