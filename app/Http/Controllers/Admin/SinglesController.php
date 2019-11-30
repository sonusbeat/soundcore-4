<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SinglesRequest;
use App\Models\Artist;
use App\Models\Single;
//use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Intervention\Image\Facades\Image;
use Storage;

class SinglesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    use ImageTrait;

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
     * @param SinglesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SinglesRequest $request)
    {
        $single = new Single($request->except(['image', 'image_alt']));

        if ($request->hasFile('image')) :
            $file = $request->image;

            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$image_name);

            $single->coverart = $image_name;
            $single->coverart_alt = $request->image_alt;
        endif;

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
    public function show($id)
    {
        $single = Single::with(['artist' => function($query) {
            $query->select('id', 'artist_name')->first();
        }])->find($id);

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
     * @param Single $single
     * @param SinglesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Single $single, SinglesRequest $request)
    {
        $single->update($request->except(['image', 'image_alt']));

        if ($request->hasFile('image')) :
            $path = 'images/releases/singles/';
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            if(Storage::exists($path.$single->coverart)) :
                Storage::delete($path.$single->coverart);
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path()."/{$path}".$image_name);

            $single->update([
                'coverart' => $image_name,
                'coverart_alt' => $request->image_alt
            ]);
        endif;

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
        $path = 'images/releases/singles/';

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
