<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /**
     * Use to drop the 's' suffix
     *
     * @var string
     */
    protected $table = 'quiz';

    /**
     * The attributes that are not allow mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Protect My FLAG from serialization
     *
     * @var array
     */
//    private $hidden = ['flag'];

    /**
     * Return true name
     *
     * @param $tar
     * @param $way 0 for Num to Alpha | 1 for Alpha to Num (Default 0)
     *
     * @return null | string
     */
    public static function getPart($tar, $way = 0)
    {
        $arr = ['web', 'pwn', 'reverse', 'misc', 'crypto']; //0 for web, 1 for pwn, 2 for re, 3 for misc, 4 for crypto
        if(!$way)
            if(isset($arr[$tar]))
                return array('status' => True, 'content' => $arr[$tar]);
            else
                return array('status' => False, 'content' => '');
        else
            if(in_array($tar,$arr))
                return array('status' => True, 'content' => array_search($tar,$arr));
            else
                return array('status' => True, 'content' => '');
    }

    /**
     * verify the flag
     *
     * @param $type
     * @param $name
     * @param $flag
     * @return bool
     */
    public static function verifyFlag($type,$name,$flag)
    {
        return !static::where(['type' => $type, 'id' => $name, 'flag' => $flag])->get()->isEmpty();
    }

    /**
     * Judge if the user win the blood
     * This method is safe because only method in queue can use this
     *
     * @param $user
     * @param $quiz_id
     *
     * @return integer
     */
    public static function isBlood($user, $quiz_id)
    {
        $record = Record::where(['user_id' => $user->id, 'quiz_id' => $quiz_id])->orderBy('created_at','asc')->get()->toArray();
        $blood = array_slice($record,0,3);
        foreach ($blood as $k => $v)
            if(in_array($user->id,$v))
                return $k + 1;
            return 0;
    }

    /**
     * get the Blood Info
     *
     * @param $quiz_id
     * @return mixed
     */
    public static function getBlood($quiz_id)
    {
        return Record::where('quiz_id','=',$quiz_id)
            ->join('users','record.user_id','=','users.id')
            ->orderBy('record.created_at','asc')
            ->select('name')
            ->get()
            ->toArray();
    }
}
