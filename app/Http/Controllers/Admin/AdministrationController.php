<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Single;
use App\Models\Stem;
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
            "singles" => Single::latestSingles('desc'),
            "albums" => Album::latestAlbums('desc'),
            "stems" => Stem::latestStems('desc')
        ];

        return view('admin.dashboard', $data);
    }
}
