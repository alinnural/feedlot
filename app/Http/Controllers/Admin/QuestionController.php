<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Question;
use Session;
use Validator;
use App\Answer;
use Carbon\Carbon;

class QuestionController extends Controller
{

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $question = Question::orderBy('created_at', 'DESC')->get();
            return Datatables::of($question)->addColumn('action', function ($question) {
                return view('admin.question._action', [
                    'model' => $question,
                    'edit_answer' => url('admin/question/edit_answer/' . $question->id),
                    'edit_url' => route('question.edit', $question->id),
                    'delete_url' => route('question.destroy', $question->id),
                    'confirm_message' => 'Are you sure to delete ' . $question->title . '?'
                ]);
            })
                ->addColumn('created_at', function ($question) {
                    $created = new Carbon($question->created_at);
                    $now = Carbon::now();

                    $difference = ($created->diff($now)->days < 2) ? $created->diffForHumans($now) : $created;
                    return $difference;
                })
                ->addColumn('name_email', function ($question) {
                    return $question->name . ' ' . $question->email;
                })
                ->addColumn('is_answered', function ($question) {
                    return $question->answers()
                        ->count() == 0 ? "<label class='label label-warning'>Draft</label>" : "<label class='label label-success'>Answered</label>";
                })
                ->make(true);
        }
        $html = $htmlBuilder->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Tanggal',
            'orderable' => false,
            'searchable' => false,
            'width' => 150
        ])
            ->addColumn([
                'data' => 'title',
                'name' => 'title',
                'title' => 'Judul',
                'width' => 200
            ])
            ->addColumn([
                'data' => 'name_email',
                'name' => 'name_email',
                'title' => 'Nama',
                'width' => 30
            ])
            ->addColumn([
                'data' => 'is_answered',
                'name' => 'is_answered',
                'title' => 'Status',
                'width' => 30
            ])
            ->addColumn([
                'data' => 'action',
                'name' => 'action',
                'title' => '',
                'orderable' => false,
                'searchable' => false,
                'width' => 150
            ]);
        return view('admin.question.index')->with(compact('html'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.question.edit')->with(compact('question'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'answer' => 'required'
        ]);

        $question = Question::find($id);
        $answer = new Answer();

        if ($question) {
            $answer->answer = $request->answer;
            $answer->question()->associate($question);
            $answer->user()->associate(Auth::user());
            $answer->save();

            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menjawab pertanyaan $question->title"
            ]);
            return redirect('admin/question');
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        if ($question) {
            $question->answers()->delete();
            $question->delete();
        } else {
            return redirect()->back();
        }

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Pertanyaan berhasil dihapus"
        ]);

        return redirect('admin/question');
    }

    public function edit_answer($id)
    {
        $answer = Answer::findOrFail($id);
        $question = $answer->question()->first();
        return view('admin.question.edit_answer')->with(compact('answer'))->with(compact('question'));
    }

    public function update_answer(Request $request, $id)
    {

    }
}
