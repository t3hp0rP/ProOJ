<?php

namespace App\Http\Controllers;

use App\Point;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance & Auth Control
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
        $this->middleware('ban');//isBan?
    }

    /**
     * Show User Center
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Auth::id();
        $point = DB::table('user_point')->where('user_id', '=', $info)->first()->point;
        $point = $point == 0 ? 0 : $point;
        return view('userCenter',[
            'info' => [
                'point' => $point,
            ],
            'message' => Session::has('message') ? Session::get('message') : null,
        ]);
    }

    /**
     * Show Or Change info
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change(Request $request)
    {
        if($request->isMethod('POST'))
        {
            if(!Auth::attempt(array('email' => Auth::user()->email, 'password' => $request->input('password')),false,true))
                return redirect()->back()->withErrors(array('password' => 'Password Error'));
            $data = $request->input();
            if($data['name'] == Auth::user()->name)
                unset($data['name']);
            if($data['phone'] == Auth::user()->phone)
                unset($data['phone']);
            unset($data['email']);
            unset($data['schoolId']);
            if($data['new_password'] == false && $data['new_password_confirmation'] == false)
            {
                unset($data['new_password']);
                unset($data['new_password_confirmation']);
            }
            $validator = Validator::make($data, [
                'name' => 'sometimes|string|max:255|unique:users',
                'new_password' => 'sometimes|required|string|min:6|confirmed',
                'new_password_confirmation' => 'sometimes|required|string|min:6',
                'password' => 'required|string|min:6',
                'phone' => 'sometimes|required|mobile|unique:users'
            ],[
                'mobile' => 'The :attribute number is invalid'
            ]);
            if($validator->fails())
                return redirect()->back()->withErrors($validator);

            if(isset($data['new_password']))
            {
                $data['password'] = bcrypt($data['new_password']);
                unset($data['new_password']);
            }
            $user = User::find(Auth::user()->id);
            if(!$user)
                return redirect('user')->with('message','Fail! Hacker?');
            $res = $user->update($data);
            if($res)
                return redirect('user')->with('message','Success');
            else
                return redirect('user')->with('message','System Fail. Try again');
        }
        $info = Auth::user();
        return view('userCenterChange',[
            'info' => [
                'email' => $info['email'],
                'schoolId' => $info['schoolId'],
                'name' => $info['name'],
                'phone' => $info['phone'],
            ]
        ]);
    }
}
