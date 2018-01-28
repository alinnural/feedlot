<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Question;
use Session;
use Validator;

class QuestionController extends Controller
{

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $question = Question::select([
                'id',
                'title',
                'email',
                'name',
                'description',
                'created_at'
            ]);
            return Datatables::of($question)->addColumn('action', function ($question) {
                return view('admin.question._action', [
                    'model' => $question,
                    'edit_url' => route('question.edit', $question->id),
                    'delete_url' => route('question.destroy', $question->id),
                    'confirm_message' => 'Are you sure to delete ' . $question->title . '?'
                ]);
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
            'width' => 100
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
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy(Request $request, $id)
    {
        
    }
}
