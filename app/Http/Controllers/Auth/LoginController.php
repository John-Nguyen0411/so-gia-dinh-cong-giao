<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use Brian2694\Toastr\Facades\Toastr;

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
        \Illuminate\Support\Facades\Session::put('url.intended',URL::previous());
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);

    }

    public function login()
    {

    return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Tài khoản đăng nhập không được trống',
            'email.email' => 'Tài khoản đăng nhập phải đúng dạng email',
            'password.required' => 'Mật khẩu không được trống',
        ]);

        $email    = $request->email;
        $password = $request->password;
        $remember_me    =   $request->has('remember_me')? true:false;
        if(auth()->attempt(['email'=>$email,'password'=>$password],$remember_me))
        {
            return Redirect::to(\Illuminate\Support\Facades\Session::get('url.intended'));
        }else{
            Toastr::error('Tài khoản hoặc mật khẩu không chính xác','Error');
            return back();
        }
    }


    public function logout()
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công','Thành công');
        return redirect('login');
    }

}
