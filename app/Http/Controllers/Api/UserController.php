<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function login()
    {
        $user = User::findUserByEmailAndPassword(request('email'), request('password'));

        if ($user instanceof User) {
            return ApiResponse::success('Login Successful', ['user' => $user->toArray()]);
        }

        return ApiResponse::error('Login Failed');
    }

    public function update(User $user)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['email', 'required'],
            'birth_date' => 'required',
            'address' => 'required',
            'pregnancy_start_at' => 'required',
            'height' => 'numeric',
        ]);

        try {
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->email = request('email');
            $user->birth_date = request('birth_date');
            $user->address = request('address');
            $user->pregnancy_start_at = request('pregnancy_start_at');
            $user->height = request('height');

            $user->save();

            return ApiResponse::success('User Successfully Updated', ['user' => $user->toArray()]);
        } catch (\Exception $e) {
            return ApiResponse::error('User Update Failed');
        }
    }

    public function uploadPhoto(User $user)
    {
        if (request()->hasFile('photo')) {
            $path = Storage::putFile('public/user_photo', request()->file('photo'));
            $url =  Storage::url($path);
            $user->photo = $url;
            $user->save();
            return ApiResponse::success('Photo Profile Successfully Uploaded', ['user' => $user->toArray()]);
        }

        return ApiResponse::error('Photo Profile Upload Failed');
    }
}
