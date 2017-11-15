<?php

namespace App\Http\Controllers\Auth;

use App\ActivationLog;
use App\Jobs\sendActivateMail;
use App\User;
use App\Mail\ActivateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'schoolId' => 'required|numeric|digits:11|unique:users',
            'email' => 'required|string|regex:/^[0-9]{11}@gdufs.edu.cn/|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|regex:/^1[34578][0-9]{9}$/|unique:users',
        ],[
            'email.regex' => '请输入正确的广外邮箱，如：2016100xxxx@gdufs.edu.cn'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'schoolId' => $data['schoolId'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    /**
     * 发送激活邮件
     *
     * @param $email
     * @param $name
     * @param $code
     */
    protected function sendMail($user, $code)
    {
        Mail::to($user)->queue(new ActivateUser($user->id, $code, $user->name));
    }

    /**
     * 保存激活码到数据库
     *
     * @param $code
     * @param $email
     */
    protected function saveCode($uid, $code, $email)
    {
        ActivationLog::create([
            'uid' => $uid,
            'email' => $email,
            'activeCode' => $code,
        ]);
    }

    /**
     * 基于Uuid的激活token
     *
     * @param $name
     * @return string
     */
    protected function genCode($name)
    {
        return Uuid::uuid5(Uuid::NAMESPACE_DNS, $name)->getHex();
    }

    /**
     * Dispatch邮件任务到队列中 实现异步
     *
     * @param $user
     * @param $code
     */
    protected function pushJobToQueue($user,$code)
    {
        $this->dispatch(new \App\Jobs\sendActivateMail($user,$code));
    }
}
