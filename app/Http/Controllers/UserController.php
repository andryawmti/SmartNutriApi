<?php

namespace App\Http\Controllers;

use App\Classes\MyHttpResponse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'birth_date' => 'required',
            'address' => 'required',
            'pregnancy_start_at' => 'required',
            'height' => 'numeric',
            'weight' => 'numeric'
        ]);

        try {
            $user = new User();
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->email = request('email');
            $user->password = Hash::make(request('password'));
            $user->birth_date = request('birth_date');
            $user->address = request('address');
            $user->pregnancy_start_at = request('pregnancy_start_at');
            $user->height = request('height');
            $user->weight = request('weight');
            $user->photo = request('photo_url');

            $user->save();

            return MyHttpResponse::storeResponse(true, 'User Successfully Created', 'user.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('manage.user.edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'birth_date' => 'required',
            'address' => 'required',
            'pregnancy_start_at' => 'required',
            'height' => 'numeric',
            'weight' => 'numeric'
        ]);

        try {
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->email = request('email');

            if (request('password') != $user->password) {
                $user->password = Hash::make(request('password'));
            }

            $user->birth_date = request('birth_date');
            $user->address = request('address');
            $user->pregnancy_start_at = request('pregnancy_start_at');
            $user->height = request('height');
            $user->weight = request('weight');
            $user->photo = request('photo_url');

            $user->save();

            return MyHttpResponse::updateResponse(true, 'User Successfully Updated', 'user.show', $user->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'user.show', $user->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return MyHttpResponse::deleteResponse(true, 'User Successfully Deleted', 'user.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'user.index');
        }
    }

    public function uploadPhoto()
    {
        $success = false;
        $url = '';
        if (request()->hasFile('file')) {
            $path = Storage::putFile('public/user_photo', request()->file('file'));
            $url =  Storage::url($path);
            $success = true;
        }

        return json_encode([
            'success' => $success,
            'url' => $url,
        ]);
    }
}
