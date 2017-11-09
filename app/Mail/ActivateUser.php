<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 发送目标邮件
     *
     * @var $email
     */
    public $email;

    /**
     * 用户名
     *
     * @var $name
     */
    public $name;

    /**
     * user ID
     *
     * @var $uid
     */
    public $uid;

    /**
     * activeCode
     *
     * @var $activeCode
     */
    public $activeCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uid, $activeCode, $name)
    {
        $this->uid = $uid;
        $this->activeCode = $activeCode;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.activate');
    }
}
