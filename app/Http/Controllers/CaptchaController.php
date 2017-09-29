<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;


class CaptchaController extends Controller
{
    public function getCaptcha($rand)
    {
        $builder = new CaptchaBuilder();
        $builder->build(100,40,null);
        $phrase = $builder->getPhrase();
        Session::flash('captcha', $phrase);
        ob_clean();
//        header("Cache-Control: no-cache, must-revalidate");
//        header('Content-type','image/jpeg');
        return response($builder->output())->headers->set('Content-type', 'image/jpeg');
    }
}
