<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponse;
use App\Mail\ResetPassword;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function login()
    {
        $user = User::findUserByEmailAndPassword(request('email'), request('password'));

        if ($user instanceof User) {
            $userArray = $user->toArray();
            $userArray['birth_date'] = date('Y-m-d', strtotime($user->birth_date));
            $userArray['pregnancy_start_at'] = date('Y-m-d', strtotime($user->pregnancy_start_at));
            $userArray['created_at'] = date('Y-m-d', strtotime($user->created_at));
            $userArray['updated_at'] = date('Y-m-d', strtotime($user->updated_at));
            return ApiResponse::success('Login Successful', ['user' => $userArray]);
        }

        return ApiResponse::error('Login Failed');
    }

    public function signUp()
    {
        $user = new User();
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->birth_date = date('Y-m-d');
        $user->address = 'Change to your address';
        $user->pregnancy_start_at = date('Y-m-d');
        $user->weight = '50';
        $user->height = '160';
        $user->created_at = date('Y-m-d');


        try {
            $user->save();
            return ApiResponse::success('Signed Up Successfully', ['user' => $user->toArray()]);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function update(User $user)
    {
        try {
            request('first_name') ? $user->first_name = request('first_name') : null;
            request('last_name') ? $user->last_name = request('last_name') : null;
            request('email') ? $user->email = request('email') : null;
            request('birth_date') ? $user->birth_date = request('birth_date') : null;
            request('address') ? $user->address = request('address') : null;
            request('pregnancy_start_at') ? $user->pregnancy_start_at = request('pregnancy_start_at') : null;
            request('height') ? $user->height = request('height') : null;

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

    public function changePassword(User $user)
    {
        $currentPassword = request('current_password');
        $newPassword = request('new_password');
        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return ApiResponse::success('Password successfully updated', ['user' => $user->toArray()]);
        }

        return ApiResponse::error('Password update failed');
    }

    public function resetPassword()
    {
        $email = request('email');

        $token = str_random(60);
        $link = url('/user-password/reset') . '/' . $token;

        $user = User::findOneByEmail($email);

        if ($user instanceof  User) {

            $resetRequset = DB::table('password_resets')->where('email', '=', $email)->first();

            if (isset($resetRequset)) {
                DB::table('password_resets')->where('email', '=', $email)->delete();
            }

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            Mail::to('andryavera@gmail.com')->send(new ResetPassword($link, $user));

            if (!Mail::failures()) {
                $response = ApiResponse::success('Reset link request has ben sent, you will receive an email soon!');
            }else{
                $response = ApiResponse::error('Reset link request failed');
            }

            return $response;
        }

        return ApiResponse::error('User with email: ' . $email . 'could not be found');
    }
}
