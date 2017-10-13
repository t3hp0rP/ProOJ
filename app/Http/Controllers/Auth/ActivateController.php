<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Mail\ActivateUser;
use App\ActivationLog;
use App\User;
use App\Point;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ActivateController extends Controller
{
    public function activateUser($uid, $activeCode)
    {
        $res = ActivationLog::where(['uid' => $uid, 'activeCode' => $activeCode])->first();
        if($res)
        {
            $res->activeTime = date('Y-m-d H:i:s');
            $res->isActive = 1;
            $user = User::find($uid);
            $user->isActive = 1;

            $res->save();
            $user->save();

            Point::create([
                'user_id' => $uid,
            ]);
        }
        return redirect('home')->with(['successMessage' => '成功激活!']);
    }

    public function resendMail($uid)
    {
        $this->middleware('auth');
        //TODO 频率限制防止DDOS
        $res = ActivationLog::where('uid', '=', $uid)->first();
        if($res)
        {
            $user = User::find($uid);
            if($user)
            {
                Mail::to($res->email)->queue(new ActivateUser($res->uid, $res->activeCode, $user->name));
                return view('auth.noticeActive',['uid' => $uid])->with('successMessage','重发成功');
            }
            else
                abort(500);
        }
        else
            abort(500);
    }
}
