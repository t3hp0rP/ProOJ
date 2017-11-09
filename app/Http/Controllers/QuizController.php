<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function addQuiz(Request $request)
    {
        $raw = $request->all();
        $quiz = new Quiz();

        $quiz->create($raw);
    }
}
