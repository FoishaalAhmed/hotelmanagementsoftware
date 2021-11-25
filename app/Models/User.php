<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function storeUser($request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/users/' . $image_full_name;
            $success         = $image->storeAs('users', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->name      = $request->name;
        $this->email     = $request->email;
        $this->phone     = $request->phone;
        $this->address   = $request->address;
        $this->hotel_id  = auth()->user()->hotel_id;
        $this->password  = Hash::make($request->password);
        $user_store      = $this->save();
        $user_id         = $this->id;

        $user_info = $this::findOrFail($user_id);
        //$user_info->assignRole($request->role_id);
        $user_info->assignRole(2);
        $user_info->syncPermissions($request->permission_id);

        $user_store
            ? session()->flash('message', 'New User Created Successfully!')
            : session()->flash('message', 'User Create Failed!');
        return $user_id;
    }


    public function updateUser($request, $id)
    {
        $user = $this::findOrFail($id);
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

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->phone     = $request->phone;
        $user->address   = $request->address;
        $user_update     = $user->save();
        $user->syncPermissions($request->permission_id);

        $user_update
            ? session()->flash('message', 'User Updated Successfully!')
            : session()->flash('message', 'User Update Failed!');
    }

    public function destroyUser($id)
    {
        $user = $this::findOrFail($id);
        if (file_exists($user->photo)) unlink($user->photo);

        $user_delete = $this::where('id', $id)->delete();

        $user_delete
            ? session()->flash('message', 'User Deleted Successfully!')
            : session()->flash('message', 'User Delete Failed!');
    }
}
