<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Validate the form data
        $this->validate($request, [
            'name'   => 'required',
            'password' => 'required|min:6'
        ]);

        //add parse test
        if ($request->get('captcha') == '' || $request->get('captcha') != Session::get('captcha'))
            return $this->sendFailedParseResponse($request);

        // Attempt to log the user in
        if ($this->guard()->attempt(['name' => $request->name, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        // if unsuccessful, then redirect back to the login with the form data
        return $this->sendFailedLoginResponse($request);
//        return redirect()->back()->withInput($request->only('name', 'remember'));
    }

    public function username()
    {
        return 'name';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        if(!$this->check())
            $request->session()->invalidate();

        return redirect('/admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
