<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $userObject;

    public function __construct()
    {
        $this->userObject = new Profile();
    }

    public function index()
    {
        $user_info = User::findOrFail(auth()->id());
        return view('backend.profile', compact('user_info'));
    }

    public function photo(Request $request)
    {
        $request->validate(Profile::$validatePhotoRule);
        $this->userObject->updateUserPhoto($request, auth()->id());
        return redirect()->back();
    }

    public function password(Request $request)
    {
        $request->validate(Profile::$validatePasswordRule);
        $this->userObject->updateUserPassword($request, auth()->id());
        return redirect()->back();
    }

    public function update(ProfileRequest $request)
    {
        $this->userObject->updateUserInfo($request, auth()->id());
        return redirect()->back();
    }
}
