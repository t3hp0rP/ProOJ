<?php

namespace App\Jobs;

use App\Point;
use App\Quiz;
use App\Record;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AddPoint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * User Instance
     *
     * @var $user
     */
    private $user;

    /**
     * Quiz ID
     *
     * @var $quizId
     */
    private $quizId;

    /**
     * request Instance
     *
     * @var $srcip
     */
    private $srcip;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $quizId, $srcip)
    {
        $this->quizId = $quizId;
        $this->user = $user;
        $this->srcip = $srcip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function(){
                $quiz = Quiz::sharedLock()->find($this->quizId);
                if(!$quiz)
                    abort('500');
                Record::create([
                    'user_id' => $this->user->id,
                    'type' => $quiz->type,
                    'quiz_id' => $this->quizId,
                    'value' => $quiz->value,
                    'src_ip' => $this->srcip,
            ]);
            //record表

            $user = Point::where('user_id','=',$this->user->id)->get()[0];
            $user->point = $user->point + $quiz->value;
            $user->save();
            //更新用户评分
        });



    }
}
