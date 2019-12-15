<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Requests\AlbumsRequest;
use App\Models\Artist;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use Intervention\Image\Facades\Image;
use Storage;

class AlbumsController extends Controller
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
        $albums = Album::with(['artist' => function($query) {
            return $query->select('id', 'artist_name');
        }])->get();

        return view('admin.albums.index', compact('albums'));
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

        return view('admin.albums.create', compact('artists', 'meta_robots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AlbumsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumsRequest $request)
    {
        $album = new Album($request->except(['coverart']));

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
                })->save(public_path().'/images/releases/albums/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/albums/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/albums/'.$thumbnail_name);

            $album->coverart = $image_name;
            $album->coverart_alt = $request->coverart_alt;
        endif;

        // Save to database
        $album->save();

        session()->flash('message', 'Album "' . $album->name . '" has been created successfully!');

        return redirect()->route('admin.albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with(['artist' => function($query) {
            $query->select('id', 'artist_name')->first();
        }])->with(['singles' => function($query) {
            $query->select('id', 'album_id', 'title')->get();
        }])->find($id);

        return view('admin.albums.show', compact('album'));
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

            "album" => Album::with(["artist" => function($query) {
                    return $query->select('id', 'artist_name');
            }])->where('id', $id)->first(),

            "meta_robots" => $this->meta_robots()
        ];

        return view('admin.albums.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AlbumsRequest $request
     * @param Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumsRequest $request, Album $album)
    {
        $album->update($request->except(['coverart']));

        if ($request->hasFile('coverart')) :
            $path = 'images/releases/albums/';
            $file = $request->coverart;
            $date = date('Ymdims');
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $large_name = self::filenameTraitment($file_name, $file_extension, $date, 'large');
            $medium_name = self::filenameTraitment($file_name, $file_extension, $date, 'medium');
            $thumbnail_name = self::filenameTraitment($file_name, $file_extension, $date, 'thumbnail');

            $image_name = self::removeExtension($file_name, $file_extension, $date);

            if(Storage::exists($path.$album->coverart.'-large.jpg')) :
                Storage::delete($path.$album->coverart.'-large.jpg');
            endif;

            if(Storage::exists($path.$album->coverart.'-medium.jpg')) :
                Storage::delete($path.$album->coverart.'-medium.jpg');
            endif;

            if(Storage::exists($path.$album->coverart.'-thumbnail.jpg')) :
                Storage::delete($path.$album->coverart.'-thumbnail.jpg');
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/albums/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/albums/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/releases/albums/'.$thumbnail_name);

            $album->update(['coverart' => $image_name]);
        endif;

        session()->flash('message', 'Album "' . $album->name . '" has been updated successfully!');

        return redirect()->route('admin.albums.index');
    }

    /**
     * Update active state of the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function active_album($id)
    {
        $album = Album::where('id', $id)->select(['id', 'name', 'active'])->first();

        if($album->active):
            $album->active = 0;
            $message = 'disabled';
        else:
            $album->active = 1;
            $message = 'enabled';
        endif;

        // Save to database
        $album->save();

        session()->flash('message', 'Album "'.$album->name.'" has been '.$message.' successfully!');

        return redirect()->route('admin.albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = 'images/releases/albums/';

        $album = Album::where('id', $id)->select(['id', 'name', 'coverart'])->first();

        // Delete file from disk
        if(Storage::exists($path.$album->coverart.'-large.jpg')) :
            Storage::delete($path.$album->coverart.'-large.jpg');
        endif;

        if(Storage::exists($path.$album->coverart.'-medium.jpg')) :
            Storage::delete($path.$album->coverart.'-medium.jpg');
        endif;

        if(Storage::exists($path.$album->coverart.'-thumbnail.jpg')) :
            Storage::delete($path.$album->coverart.'-thumbnail.jpg');
        endif;

        // Delete from database
        $album->delete();

        session()->flash('message', 'Album "'.$album->name.'" has been deleted successfully!');

        return redirect()->route('admin.albums.index');
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
