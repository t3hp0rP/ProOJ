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
        return Point::join('users','users.id','=','user_point.user_id')->orderBy('point','desc')->orderBy('users.id')->select('name','point')->paginate(10);
    }

    /**
     * 获取当前用户分数
     *
     * @param $id
     * @return mixed
     */
    public static function getPoint($id)
    {
        $res = Point::where('user_id','=',$id)->select('point')->first();
        return $res ? $res->point : 0;
    }
}
