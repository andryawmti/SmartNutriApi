<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('guest');*/
    }

    public function showUserResetPasswordForm($token = null)
    {
        return view('auth.passwords.user_reset', ['token' => $token]);
    }

    public function userResetPassword(Request $request)
    {
        request()->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
        ]);

        $email = request('email');
        $password = request('password');
        $token = request('token');

        $user = User::findOneByEmail($email);

        $resetRequest = DB::table('password_resets')->where([
            ['email', '=', $email],
            ['token', '=', $token]
        ]);

        if ($user instanceof User && isset($resetRequest)) {
            $user->password = Hash::make($password);
            $user->save();

            DB::table('password_resets')->where([
                ['email', '=', $email]
            ])->delete();

            return $this->sendResetResponse($request, Password::PASSWORD_RESET);
        }

        return $this->sendResetFailedResponse($request, Password::INVALID_TOKEN);
    }
}

