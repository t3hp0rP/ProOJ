<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationLog extends Model
{
    protected $table = 'activation_log';

    protected $fillable = ['uid','email','activeCode','activeTime'];
}
