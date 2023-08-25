<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $req)
    {
        // validate credentials
        $credentials = $req->validate([
            'email' => 'required|email',

        ]);

        if (Auth::attempt()) {
            $user_role = Auth::user()->role;

            switch ($user_role) {
                case 1:
                    return redirect('/super_admin');
                case 2:
                    return redirect('/admin');
                case 3:
                    return redirect('/dept');
                case 4:
                    return redirect('/staff');
                case 5:
                    return redirect('/client');
                default:
                    Auth::logout();
                    return redirect('/login')->with('error', 'Ooops something went wrong!');
            }
        } else {
            return redirect('/login');
        }
    }
}
