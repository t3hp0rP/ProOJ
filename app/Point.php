<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'user_point';

    protected $fillable = ['user_id','point'];

    /**
     * 获取排行
     *
     * @return mixed
     */
    public static function getRank()
    {
        return Point::join('users','users.id','=','user_point.user_id')->orderBy('point','desc')->select('name','point')->paginate(10);
    }

    /**
     * 获取当前用户分数
     *
     * @param $id
     * @return mixed
     */
    public static function getPoint($id)
    {
        return Point::where('user_id','=',$id)->select('point')->first()->point;
    }
}
