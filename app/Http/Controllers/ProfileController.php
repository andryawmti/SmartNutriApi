<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Classes\MyHttpResponse;
use App\Rules\ValidatePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('partials.profile');
    }

    public function profileUpdate(Admin $admin)
    {
        try {
            request()->validate([
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $admin->first_name = request('first_name');
            $admin->last_name = request('last_name');
            $admin->email = request('email');
            $admin->address = request('address');
            $admin->photo = request('photo_url');
            $admin->save();
            return MyHttpResponse::updateResponse(true, 'Profile Successfully Updated', 'profile');
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'home');
        }
    }

    public function changePassword(Admin $admin)
    {
        request()->validate([
            'current_password' => ['required', new ValidatePassword($admin)],
            'new_password' => ['required', 'min:6', 'max:35', 'confirmed'],
            'new_password_confirmation' => ['required']
        ]);

        try {
            $admin->password = Hash::make(request('new_password'));
            $admin->save();
            return MyHttpResponse::updateResponse(true, 'Password Successfully Updated', 'profile');
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'profile');
        }
    }

    public function generateToken()
    {
        return  auth::user()->generateApiToken();
    }

    public function uploadPhoto()
    {
        $success = false;
        $url = '';
        if (request()->hasFile('file')) {
            $path = Storage::putFile('public/admin_photo', request()->file('file'));
            $url =  Storage::url($path);
            $success = true;
        }

        return json_encode([
            'success' => $success,
            'url' => $url,
        ]);
    }
}
