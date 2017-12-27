<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Carbon\Carbon;
use App\Http\Requests\ReCaptchataTestFormRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_by', 'desc')
            ->paginate(10);

        return view('question.index')
            ->with(compact('questions'));
    }

    public function showQuestion($id)
    {
        $question = Question::find($id);        
        return view('question.show')
                 ->with(compact('question'));
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(ReCaptchataTestFormRequest $request)
    {
        Question::save($request);
    }
}
