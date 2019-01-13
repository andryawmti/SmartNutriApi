<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Classes\MyHttpResponse;
use App\Rules\ValidatePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
