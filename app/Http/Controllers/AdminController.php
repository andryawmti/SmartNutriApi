<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Classes\MyHttpResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.admin.index', ['admins' => Admin::all()]);
    }

    public function store()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'address' => 'required',
        ]);

        try {
            $admin = new Admin();
            $admin->first_name = request('first_name');
            $admin->last_name = request('last_name');
            $admin->email = request('email');
            $admin->password = Hash::make(request('password'));
            $admin->address = request('address');
            $admin->api_token = str_random(60);
            $admin->photo = request('photo_url');

            $admin->save();

            return MyHttpResponse::storeResponse(true, 'Admin Successfully Created', 'admin.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'admin.index');
        }
    }

    public function show(Admin $admin)
    {
        return view('manage.admin.edit', ['admin' => $admin]);
    }

    public function update(Admin $admin)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'address' => 'required',
        ]);

        try {
            $admin->first_name = request('first_name');
            $admin->last_name = request('last_name');
            $admin->email = request('email');
            $admin->password = Hash::make(request('password'));
            $admin->address = request('address');
            $admin->photo = request('photo_url');

            $admin->save();

            return MyHttpResponse::updateResponse(true, 'Admin Successfully Updated', 'admin.show', $admin->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'admin.show', $admin->id);
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return MyHttpResponse::deleteResponse(true, 'Admin Successfully Deleted', 'admin.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'admin.index');
        }
    }

    public function generateToken(Admin $admin)
    {
        return $admin->generateApiToken();
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
