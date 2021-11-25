<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Session;

class Profile extends Model
{
    /**
     * Define table user.
     */

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $validatePasswordRule = [

        'old_password'    => 'required|string',
        'new_password'    => 'required|string|min:8',
    ];

    public static $validatePhotoRule = [

        'photo' => 'mimes:jpeg,jpg,png,gif,webp|required|max:1000',
    ];

    public function updateUserPhoto($request, $id)
    {
        $user  = $this::findOrFail($id);

        $image = $request->file('photo');

        if ($image) {

            if (file_exists($user->photo)) unlink($user->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/users/' . $image_full_name;
            $success         = $image->storeAs('users', $image_full_name, 'parent_disk');
            $user->photo     = $image_url;
        }

        $user_update       = $user->save();

        if ($user_update) {

            Session::flash('message', 'User Photo Updated Successfully!');

        } else {

            Session::flash('message', 'User Photo Update Failed!');
        }
    }

    public function updateUserPassword($request, $id)
    {
        $user = $this::findOrFail($id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([

                'password' => Hash::make($request->new_password)

            ])->save();

            Session::flash('message', 'User Password Updated Successfully!');
        } else {

            Session::flash('message', 'User Password Updated Successfully!');
        }
    }

    public function updateUserInfo($request, $id)
    {
        $user  = $this::findOrFail($id);

        $user->name     = $request->name;
        $user->address  = $request->address;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user_update    = $user->save();

        if ($user_update) {

            Session::flash('message', 'Profile Info Updated Successfully!');

        } else {

            Session::flash('message', 'Profile Info Update Failed!');
        }
    }
}
