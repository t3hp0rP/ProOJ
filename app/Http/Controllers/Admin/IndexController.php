<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizs =  QuizController::getQuiz();
        $userInit = User::initDetail();
        $users = User::initUser();
        $errorMessage = is_null(session('error')) ? '' : session('error');
        $successMessage = is_null(session('success')) ? '' : session('success');
        return view('admin.home',[
            'quizs' => $quizs,
            'error' => $errorMessage,
            'success' => $successMessage,
            'registerNum' => $userInit['registerNum'],
            'activeNum' => $userInit['activeNum'],
            'users' => $users, //TODO 懒加载
        ]);
    }
}
