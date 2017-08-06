<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationLog extends Model
{
    protected $table = 'activationLog';

    protected $fillable = ['uid','email','activeCode','activeTime'];
}
