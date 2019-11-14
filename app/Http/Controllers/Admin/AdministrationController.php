<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministrationController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
