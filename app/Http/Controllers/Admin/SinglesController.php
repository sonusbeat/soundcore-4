<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Single;
use Illuminate\Http\Request;
use Storage;

class SinglesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singles = Single::with(['artist' => function($query) {
            return $query->select('id', 'artist_name');
        }])->get();

        return view('admin.singles.index', compact('singles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::select('artist_name', 'id')->get();
        $meta_robots = $this->meta_robots();

        return view('admin.singles.create', compact('artists', 'meta_robots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $single = new Single($request->except(['image', 'image_alt']));

        // Save to database
        $single->save();

        session()->flash('message', 'Single "'.$single->title.'" has been created successfully!');

        return redirect()->route('admin.singles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Single $single)
    {
        return view('admin.singles.show', compact('single'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [

            "artists" => Artist::select('artist_name', 'id')->get(),

            "single" => Single::with(["artist" => function($query) {
                return $query->select('id', 'artist_name');
            }])->where('id', $id)->first(),

            "meta_robots" => $this->meta_robots()
        ];

        return view('admin.singles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Artist $artist
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Single $single, Request $request)
    {
        $single->update($request->except(['image', 'image_alt']));

        session()->flash('message', 'Single "'.$single->title.'" has been updated successfully!');

        return redirect()->route('admin.singles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = 'images/singles/';

        $single = Single::where('id', $id)->select(['id', 'title', 'coverart'])->first();

        // Delete file from disk
        if(Storage::exists($path.$single->coverart)) :
            Storage::delete($path.$single->coverart);
        endif;

        // Delete from database
        $single->delete();

        session()->flash('message', 'Single "'.$single->title.'" has been deleted successfully!');

        return redirect()->route('admin.singles.index');
    }

        /**
     * Update active state of the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function active_single($id)
    {
        $single = Single::where('id', $id)->select(['id', 'title', 'active'])->first();

        if($single->active):
            $single->active = 0;
            $message = 'disabled';
        else:
            $single->active = 1;
            $message = 'enabled';
        endif;

        // Save to database
        $single->save();

        session()->flash('message', 'Single "'.$single->title.'" has been '.$message.' successfully!');

        return redirect()->route('admin.singles.index');
    }

    private function meta_robots()
    {
        return [
            "Index, Follow" => "index, follow",
            "Index, No Follow" => "index, nofollow",
            "No Index, Follow" => "noindex, follow",
            "No Index, No Follow" => "noindex, nofollow",
        ];
    }
}
