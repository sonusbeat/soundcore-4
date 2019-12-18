<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtistsRequest;
//use Illuminate\Http\Request;
use App\Models\Artist;
use App\Traits\ImageTrait;
use Storage;
use Intervention\Image\Facades\Image;


class ArtistsController extends Controller
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
        $artists = Artist::all();

        return view('admin.artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta_robots = $this->meta_robots();

        return view('admin.artists.create', compact('meta_robots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistsRequest $request)
    {
        $artist = new Artist($request->except(['image', 'image_alt']));

        if ($request->hasFile('image')) :
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/artists/'.$image_name);

            $artist->image = $image_name;
            $artist->image_alt = $request->image_alt;
        endif;

        // Save to database
        $artist->save();

        session()->flash('message', 'Artist "'.$artist->artist_name.'" has been created successfully!');

        return redirect()->route('admin.artists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::artistSingles()->artistAlbums()->artistStems()->find($id);

        return view('admin.artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        $meta_robots = $this->meta_robots();

        return view('admin.artists.edit', compact('artist', 'meta_robots'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistsRequest $request, Artist $artist)
    {
        $artist->update($request->except(['image', 'image_alt']));

        if ($request->hasFile('image')) :
            $path = 'images/artists/';
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            if(Storage::exists($path.$artist->image)) :
                Storage::delete($path.$artist->image);
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path()."/{$path}".$image_name);

            $artist->update([
                'image' => $image_name,
                'image_alt' => $request->image_alt
            ]);
        endif;

        session()->flash('message', 'Artist "'.$artist->artist_name.'" has been updated successfully!');

        return redirect()->route('admin.artists.index');
    }

    /**
     * Update active state of the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function active_artist($id)
    {
        $artist = Artist::where('id', $id)->select(['id', 'artist_name', 'active'])->first();

        if($artist->active):
            $artist->active = 0;
            $message = 'disabled';
        else:
            $artist->active = 1;
            $message = 'enabled';
        endif;

        // Save to database
        $artist->save();

        session()->flash('message', 'Artist "'.$artist->artist_name.'" has been '.$message.' successfully!');

        return redirect()->route('admin.artists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = 'images/artists/';

        $artist = Artist::where('id', $id)->select(['id', 'artist_name', 'image'])->first();

        // Delete file from disk
        if(Storage::exists($path.$artist->image)) :
            Storage::delete($path.$artist->image);
        endif;

        // Delete from database
        $artist->delete();

        session()->flash('message', 'Artist "'.$artist->artist_name.'" has been deleted successfully!');

        return redirect()->route('admin.artists.index');
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
