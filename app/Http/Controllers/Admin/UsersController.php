<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Models\User;
use App\Traits\ImageTrait;
use Storage;

class UsersController extends Controller
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
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UsersCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {
        $user = new User($request->except(['image','password']));

        if ($request->hasFile('image')) :
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path().'/images/users/'.$image_name);

            $user->image = $image_name;
        endif;

        $user->password = bcrypt(request()->password);

        // Save to database
        $user->save();

        session()->flash('message', 'User "'.$user->username.'" has been created successfully!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateRequest $request, User $user)
    {
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->username = request()->username;

        if ($request->hasFile('image')) :
            $path = 'images/users/';
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();

            $image_name = self::filenameTraitment($file_name, $file_extension);

            if(Storage::exists($path.$user->image)) :
                Storage::delete($path.$user->image);
            endif;

            Image::make($file->getRealPath())
                ->resize(1280, null, function ($constrain) {
                    $constrain->aspectRatio();
                })->save(public_path()."/{$path}".$image_name);

            $user->image = $image_name;
        endif;

        $user->email = request()->email;

        if(request()->password != ''):
            $user->password = bcrypt(request()->password);
        endif;

        $user->type = request()->type;

        // Save to database
        $user->save();

        session()->flash('message', 'User "'.$user->username.'" has been updated successfully!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Update active state of the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function active_user($id)
    {
        $user = User::where('id', $id)->select(['id','first_name','last_name','active'])->first();

        if($user->active):
            $user->active = 0;
            $message = 'disabled';
        else:
            $user->active = 1;
            $message = 'enabled';
        endif;

        // Save to database
        $user->save();

        session()->flash('message', 'User "'.$user->full_name().'" has been '.$message.' successfully!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = 'images/users/';

        $user = User::where('id', $id)->select(['id', 'first_name', 'last_name', 'image'])->first();

        // Delete file from disk
        if(Storage::exists($path.$user->image)) :
            Storage::delete($path.$user->image);
        endif;

        // Delete from database
        $user->delete();

        session()->flash('message', 'User "'.$user->full_name().'" has been deleted successfully!');

        return redirect()->route('admin.users.index');
    }
}
