<?php

namespace App\Http\Controllers\Admin;

use App\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
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

    public static function getQuiz()
    {
        return Quiz::paginate(10);
    }

    private function validator($input,$isUpdate = 0)
    {
        if ($isUpdate == 1)
        {
            $titleRule = 'sometimes|unique:quiz';
            $flagRule = 'somtimes|unique:quiz';
        }
        else
        {
            $titleRule = 'required|unique:quiz';
            $flagRule = 'required|unique:quiz';
        }

        return Validator::make($input, [
            'type' => 'required|in:web,pwn,misc,reverse,crypto',
            'title' => $titleRule,
            'description' => 'required',
            'addr' => 'required',
            'value' => 'required|numeric',
            'flag' => $flagRule,
            'active' => 'sometimes|accepted',
        ]);
    }

    public function createQuiz(Request $request)
    {
        $input = $request->input();

        $validator = $this->validator($input);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $input['type'] = Quiz::getPart($input['type'],1)['content'];

        $quizModel = new Quiz();
        $res = $quizModel->create([
            'type' => $input['type'],
            'title' => $input['title'],
            'content' => $input['description'],
            'addr' => $input['addr'],
            'value' => $input['value'],
            'flag' => $input['flag'],
            'active' => isset($input['active']) ? $input['active'] : 0,
        ]);
        if (!$res)
            return redirect()->back()->with('error','save quiz error');
        else
        {
            $request->session()->forget('tempQuizFile');
            return redirect('/admin');
        }
    }

    public function uploadQuizFile(Request $request,$id = '')
    {
        $fileName = $request->get('name');
        $file = $request->file('file');
        if (!$file->isValid())
            return response()->json(['code' => 0, 'error' => 'upload error']);
        $fileName = $fileName.'.'.md5_file($file->getRealPath());
        $res = $file->storeAs('/static',$fileName,['visibility' => 'public']);
        @chmod($res,0777);
        if ($id == '')
        {
            if (!$res)
                return response()->json(['code' => 0, 'error' => 'save error']);
            session(['tempQuizFile' => $res]);
            return response()->json(['code' => 1 , 'url' => env('APP_URL').$res]);
        }
        else
        {
            $quiz = Quiz::find($id);
            if (!$quiz)
                return response()->json(['code' => 0, 'error' => 'Can not find this quiz!']);
            $quiz->update(['addr' => env('APP_URL').$res]);
            session(['tempQuizFile'.$id]);
            return response()->json(['code' => 1, 'url' => env('APP_URL').$res]);
        }
    }

    public function removeQuizFile(Request $request,$id = '')
    {
        if ($id == '')
        {
            if (session('tempQuizFile') == '')
                return response()->json(['code' => 0, 'error' => session('tempQuizFile')]);
            if (Storage::delete(session('tempQuizFile')))
            {
                $request->session()->forget('tempQuizFile');
                return response()->json(['code' => 1]);
            }
            else
                return response()->json(['code' => 0]);
        }
        else
        {
            $res = Quiz::find($id);
            if (!$res)
                return response()->json(['code' => 0, 'error' => 'Can not find this quiz!']);
            if (substr($res->addr,0,strlen(env('APP_URL'))+6) != env('APP_URL').'static')
                return response()->json(['code' => 0, 'error' => 'Can not delete this File!']);
            if (Storage::delete(substr($res->addr,strlen(env('APP_URL')))))
            {
                $res->addr = '';
                $res->save();
                return response()->json(['code' => 1]);
            }
            else
                return response()->json(['code' => 0,'error' => 'Delete error!']);
        }
    }

    public function changeQuiz(Request $request,$id)
    {
        if ($request->method() != 'POST')
        {
            $res = Quiz::find($id);
            if (!$res)
                return redirect('/admin')->with('error', 'cannot find this quiz');
            return view('admin.changeQuiz',['content' => $res]);
        }
        elseif ($request->method() == 'POST')
        {
            $res = Quiz::find($id);
            if (!$res)
                return redirect()->back()->with('error','cannot find this quiz!');

            $input = $request->input();

            if ($res->flag == $input['flag'])
                unset($input['flag']);
            if ($res->title == $input['title'])
                unset($input['title']);

            $validator = $this->validator($input,1);

            if ($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
            $input['type'] = Quiz::getPart($input['type'],1)['content'];

            $res->type = $input['type'];
            $res->title = isset($input['title']) ? $input['title'] : $res->title;
            $res->content = $input['description'];
            $res->addr = $input['addr'];
            $res->value = $input['value'];
            $res->flag = isset($input['flag']) ? $input['flag'] : $res->flag;
            $res->active = isset($input['active']) ? $input['active'] : 0;

            if ($res->save())
                return redirect('/admin')->with('success','Update Success!');
            else
                return redirect()->back()->withInput()->with('error','Something Wrong!');

        }
    }

    public function delQuiz($id)
    {
        $res = Quiz::find($id);
        if (!$res)
            return redirect()->back()->with('error','cannot find this quiz');
        if (Storage::exists(str_replace(env('APP_URL'),'',$res->addr)))
            Storage::delete(str_replace(env('APP_URL'),'',$res->addr));
        if ($res->delete())
            return redirect('/admin')->with('success','success');
        else
            return redirect('/admin')->with('error','unknown error');
    }
}
