<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MemberUpdateRequest;
use App\Http\Requests\MemberCreateRequest;
use App\Http\Controllers\Controller;

use App\Role;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) 
        {
            $member = Role::where('name', 'member')->first()->users;
            return Datatables::of($member)
                ->addColumn('name', function($member) {
                    return '<a href="'.route('member.show', $member->id).'">'.$member->name.'</a>'; })
                ->addColumn('action', function($member){
                    return view('admin.datatable._action', [
                        'model'           => $member,
                        //'form_url'        => route('member.destroy', $member->id),
                        'edit_url' => route('member.edit', $member->id),
                        'delete_url' => route('member.destroy', $member->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $member->name . '?'
                    ]);
                })->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false,'width'=>100]);
        return view('admin.member.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberCreateRequest $request)
    {
        $password = str_random(6);
        $data = $request->all();
        $data['password'] = bcrypt($password);
        
        // bypass verifikasi
        $data['is_verified'] = 1;
        $member = User::create($data);
        
        // set role
        $memberRole = Role::where('name', 'member')->first();
        $member->attachRole($memberRole);
        
        // kirim email
        Mail::send('auth.emails.invite', compact('member', 'password'), function ($m) use ($member) {
            $m->to($member->email, $member->name)->subject('Anda telah didaftarkan di Larapus!');
        });
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil menyimpan member dengan email " .
                "<strong>" . $data['email'] . "</strong>" .
                " dan password <strong>" . $password . "</strong>."
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::find($id);
        return view('admin.member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::find($id);
        return view('admin.member.edit')->with(compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request, $id)
    {
        $member = User::find($id);
        $member->update($request->only('name','email'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $member->name"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = User::find($id);
        if ($member->hasRole('member')) { $member->delete(); Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Member berhasil dihapus"
            ]);
        }
        return redirect()->route('member.index');
    }

    public function profile()
    {
        $member = User::findOrFail(Auth::user()->id);
        if(empty($member))
        {
            redirect('/admin');
        }

        return view('admin.member.profile')->with(compact('member'));
    }
}
