<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class sendActivateMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * User Instance
     *
     * @var $user
     */
    private $user;

    /**
     * Acvtivation code
     *
     * @var $code
     */
    private $code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->user,new \App\Notifications\sendActivateMail($this->user->id, $this->code));//利用Notifications通道发送漂亮的Mail
    }
}
