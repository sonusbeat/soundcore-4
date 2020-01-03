<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StemsRequest;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Stem;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StemsController extends Controller
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
        $stems = Stem::StemArtist()
            ->StemAlbum()
            ->select(['id', 'artist_id', 'album_id', 'title', 'meta_robots', 'active'])->get();

        return view('admin.stems.index', compact('stems'));
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
            'albums' => Album::select('name', 'id')->get(),
            'meta_robots' => $this->meta_robots()
        ];

        return view('admin.stems.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StemsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StemsRequest $request)
    {
        $stem = new Stem($request->except(['coverart']));

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
                })->save(public_path().'/images/stems/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/stems/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/stems/'.$thumbnail_name);

            $stem->coverart = $image_name;
            $stem->coverart_alt = $request->coverart_alt;
        endif;

        // Save to database
        $stem->save();

        session()->flash('message', 'Stem "'.$stem->title.'" has been created successfully!');

        return redirect()->route('admin.stems.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stem = Stem::with(['artist' => function($query) {
            $query->select('id', 'artist_name')->first();
        }])->find($id);

        return view('admin.stems.show', compact('stem'));
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

            'albums' => Album::select('name', 'id')->get(),

            "stem" => Stem::with(["artist" => function($query) {
                return $query->select('id', 'artist_name');
            }])->where('id', $id)->first(),

            "meta_robots" => $this->meta_robots()
        ];

        return view('admin.stems.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StemsRequest $request
     * @param Stem $stem
     * @return \Illuminate\Http\Response
     */
    public function update(StemsRequest $request, Stem $stem)
    {
        $stem->update($request->except(['coverart']));

        if ($request->hasFile('coverart')) :
            $path = 'images/stems/';
            $file = $request->coverart;
            $date = date('Ymdims');
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $large_name = self::filenameTraitment($file_name, $file_extension, $date, 'large');
            $medium_name = self::filenameTraitment($file_name, $file_extension, $date, 'medium');
            $thumbnail_name = self::filenameTraitment($file_name, $file_extension, $date, 'thumbnail');

            $image_name = self::removeExtension($file_name, $file_extension, $date);

            if(Storage::exists($path.$stem->coverart.'-large.jpg')) :
                Storage::delete($path.$stem->coverart.'-large.jpg');
            endif;

            if(Storage::exists($path.$stem->coverart.'-medium.jpg')) :
                Storage::delete($path.$stem->coverart.'-medium.jpg');
            endif;

            if(Storage::exists($path.$stem->coverart.'-thumbnail.jpg')) :
                Storage::delete($path.$stem->coverart.'-thumbnail.jpg');
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/stems/'.$large_name);

            Image::make($file->getRealPath())
                ->resize(780, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/stems/'.$medium_name);

            Image::make($file->getRealPath())
                ->resize(480, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/stems/'.$thumbnail_name);

            $stem->update(['coverart' => $image_name]);
        endif;

        session()->flash('message', 'Stem "'.$stem->title.'" has been updated successfully!');

        return redirect()->route('admin.stems.index');
    }

        /**
     * Update active state of the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function active_stem($id)
    {
        $stem = Stem::where('id', $id)->select(['id', 'title', 'active'])->first();

        if($stem->active):
            $stem->active = 0;
            $message = 'disabled';
        else:
            $stem->active = 1;
            $message = 'enabled';
        endif;

        // Save to database
        $stem->save();

        session()->flash('message', 'Stem "'.$stem->title.'" has been '.$message.' successfully!');

        return redirect()->route('admin.stems.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = 'images/stems/';

        $stem = Stem::where('id', $id)->select(['id', 'title', 'coverart'])->first();

        // Delete file from disk
        if(Storage::exists($path.$stem->coverart.'-large.jpg')) :
            Storage::delete($path.$stem->coverart.'-large.jpg');
        endif;

        if(Storage::exists($path.$stem->coverart.'-medium.jpg')) :
            Storage::delete($path.$stem->coverart.'-medium.jpg');
        endif;

        if(Storage::exists($path.$stem->coverart.'-thumbnail.jpg')) :
            Storage::delete($path.$stem->coverart.'-thumbnail.jpg');
        endif;

        // Delete from database
        $stem->delete();

        session()->flash('message', 'Single "'.$stem->title.'" has been deleted successfully!');

        return redirect()->route('admin.stems.index');
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
