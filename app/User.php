<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'schoolId','email', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function initDetail()
    {
        $registerNum = User::where('isActive','=',1)->count();
        $activeNum = ActivationLog::all()->count();
        return ['registerNum' => $registerNum, 'activeNum' => $activeNum];
    }

    public static function initUser()
    {
        return User::paginate(10,['*'],'user');
    }
}
