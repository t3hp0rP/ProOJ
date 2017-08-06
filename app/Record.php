<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'record';

    protected $fillable = ['user_id','type','quiz_id','value','src_ip'];

    /**
     * Check if the user has answered this quiz
     *
     * @param $user_id
     * @param $quiz_id
     * @return bool
     */
    public static function checkAnswered($user_id,$quiz_id)
    {
        if(Record::where(['user_id' => $user_id, 'quiz_id' => $quiz_id])->first())
            return true;
        else
            return false;
    }

    public static function getQuizRecord($user_id,$type)
    {
        return Record::where(['user_id' => $user_id, 'type' => $type])->select('quiz_id')->orderBy('quiz_id','asc')->get()->toArray();
    }
}
