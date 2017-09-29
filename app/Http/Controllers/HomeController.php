<?php

namespace App\Http\Controllers;

use App\Point;
use App\Quiz;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance & Auth Control
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('active');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with([
            'errorMessage' => Session::has('errorMessage') ? Session::get('errorMessage') : '',
            'successMessage' => Session::has('successMessage') ? Session::get('successMessage') : '',
        ]);
    }

    public function getRank()
    {
        $ranks = Point::getRank();
        return view('rank', ['ranks' => $ranks]);
    }


    /**
     * Show the individual quiz part.
     *
     * @return \Illuminate\Http\Response
     */
    public function enterPart($part)
    {
        if($part == null || !Quiz::getPart($part, 1)['status']) //block illegal route
            abort('404');

        $truePart = Quiz::getPart($part, 1)['content'];
        $quizDatas = Quiz::where('type','=',$truePart)->select('id','type','title','content','addr','value','created_at')->get(); //fetch quiz data
        $answered = Record::getQuizRecord(Auth::id(), $truePart);
        $bloods = []; //quiz's blood
        $info = []; //isAnswered
        foreach ($quizDatas as $quizData)
            $bloods[] = Quiz::getBlood($quizData->id);
        foreach ($answered as $item)
            $info[$item['quiz_id']] = 1;
        return view('layouts/quiz',[
            'part' => ucfirst(Quiz::getPart($truePart)['content']),
            'quizDatas' => $quizDatas,
            'bloods' => $bloods,
            'info' => $info,
        ]);
    }
}
