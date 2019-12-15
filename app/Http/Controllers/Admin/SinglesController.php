<?php

namespace App\Http\Controllers\Admin;

use App\Album;
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
            $query->select('id', 'artist_name');
        }])->with(['album' => function($query) {
            $query->select('id', 'name');
        }])->select(['id', 'artist_id', 'album_id', 'title', 'meta_robots', 'active'])->get();

//        return $singles;

        return view('admin.singles.index', compact('singles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'artists' => Artist::select('artist_name', 'id')->get(),
            "albums" => Album::select(['id', 'name'])->get(),
            'meta_robots' => $this->meta_robots()
        ];

        return view('admin.singles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SinglesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SinglesRequest $request)
    {
        $single = new Single($request->except(['coverart']));

        if ($request->hasFile('coverart')) :
            $file = $request->coverart;
            $date = date('Ymdims');
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $large_name = self::filenameTraitment($file_name, $file_extension, $date, 'large');
            $medium_name = self::filenameTraitment($file_name, $file_extension, $date, 'medium');
            $thumbnail_name = self::filenameTraitment($file_name, $file_extension, $date, 'thumbnail');

            $image_name = self::removeExtension($file_name, $file_extension, $date);

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$thumbnail_name);

            $single->coverart = $image_name;
            $single->coverart_alt = $request->coverart_alt;
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

            "albums" => Album::select(['id', 'name'])->get(),

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
        $single->update($request->except(['coverart']));

        if ($request->hasFile('coverart')) :
            $path = 'images/releases/singles/';
            $file = $request->coverart;
            $date = date('Ymdims');
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $large_name = self::filenameTraitment($file_name, $file_extension, $date, 'large');
            $medium_name = self::filenameTraitment($file_name, $file_extension, $date, 'medium');
            $thumbnail_name = self::filenameTraitment($file_name, $file_extension, $date, 'thumbnail');

            $image_name = self::removeExtension($file_name, $file_extension, $date);

            if(Storage::exists($path.$single->coverart.'-large.jpg')) :
                Storage::delete($path.$single->coverart.'-large.jpg');
            endif;

            if(Storage::exists($path.$single->coverart.'-medium.jpg')) :
                Storage::delete($path.$single->coverart.'-medium.jpg');
            endif;

            if(Storage::exists($path.$single->coverart.'-thumbnail.jpg')) :
                Storage::delete($path.$single->coverart.'-thumbnail.jpg');
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/singles/'.$thumbnail_name);

            $single->update(['coverart' => $image_name]);
        endif;

        session()->flash('message', 'Single "'.$single->title.'" has been updated successfully!');

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
        if(Storage::exists($path.$single->coverart.'-large.jpg')) :
            Storage::delete($path.$single->coverart.'-large.jpg');
        endif;

        if(Storage::exists($path.$single->coverart.'-medium.jpg')) :
            Storage::delete($path.$single->coverart.'-medium.jpg');
        endif;

        if(Storage::exists($path.$single->coverart.'-thumbnail.jpg')) :
            Storage::delete($path.$single->coverart.'-thumbnail.jpg');
        endif;

        // Delete from database
        $single->delete();

        session()->flash('message', 'Single "'.$single->title.'" has been deleted successfully!');

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
