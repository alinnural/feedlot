<?php
namespace App\Http\Controllers;

use App\Question;
use App\Http\Requests\ReCaptchataTestFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->paginate(10);
        
        return view('question.index')->with(compact('questions'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $questions = Question::SearchByKeyword($keyword)->paginate(10);
        return view('question.search-result')->with(compact('questions'))->with('keyword',$keyword);
    }

    public function showQuestion($id)
    {
        $question = Question::find($id);
        return view('question.show')->with(compact('question'));
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(ReCaptchataTestFormRequest $request)
    {
        Question::create($request->postFillData());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengajukan pertanyaan"
        ]);
        return redirect()->route('tanya.jawab.index');
    }
}
