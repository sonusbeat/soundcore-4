<?php

namespace App\Http\Controllers\Admin;

use App\Models\Single;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministrationController extends Controller
{
    /**
     * AdministrationController constructor
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show dashboard view
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data = [
            "singles" => Single::latestSingles('desc')
        ];

        return view('admin.dashboard', $data);
    }
}
