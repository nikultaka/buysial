<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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

    use AuthenticatesUsers, DispatchesJobs, ValidatesRequests;

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

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email'                 => 'required|email',
                'password'              => 'required|min:8|max:20|regex:/^[A-Za-z0-9 ]+$/|alpha_dash',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard')->with(['message' => 'You are successfully logged in.', 'type' => 'success']);
            } else {
                return redirect()->route('admin.login')->with(['message' => 'Email-Address and Password are wrong.', 'type' => 'error']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login')->with('success', 'You have been successfully logged out.');
    }
}
