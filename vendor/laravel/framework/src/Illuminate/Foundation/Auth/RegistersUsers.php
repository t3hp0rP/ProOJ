<?php

namespace Illuminate\Foundation\Auth;

use App\Point;
use App\Notifications\sendActivateMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

trait RegistersUsers
{
    use RedirectsUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.(注册后置操作)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Point::create([
            'user_id' => $user->id,
        ]);
        $code = $this->genCode($user->name); //根据名称获得Uuid
        $this->saveCode($user->id, $code, $user->email);//保存激活码
        //$this->sendMail($user, $code);//直接发送邮件
        //        $user->notify(new sendActivateMail($user->id, $code));//不知道为什么莫名其妙没有加到队列 之后加了redis之后再试试把
        //        Notification::send($user,new sendActivateMail($user->id, $code));//利用Notifications通道发送漂亮的Mail
        $this->pushJobToQueue($user,$code);
    }
}
