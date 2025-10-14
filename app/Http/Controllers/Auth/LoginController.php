<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Auth;

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

    // use AuthenticatesUsers;

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
        $this->middleware('auth')->only('logout');
    }

    public function index()
    {
        if (!empty(session('error_msg')))
            Alert::error('Fail !', session('error_msg'))->persistent('Close');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'))->persistent('Close');
        
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $getHost = request()->getHost();

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => User::STATUS['active']
        ];
        
        try {
            if (!Auth::attempt($credentials)) {
                return redirect()->back()->with('error_msg', 'Kredensial yang anda masukkan salah!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error_msg', 'Terjadi Kesalahan!');
        }

        return redirect()->route('backsite.dashboard.index');
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('login')->withSuccess('You have successfully logged out !');
    }
}
