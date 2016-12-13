<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Feed;
use App\GroupFeed;
use Session;

class FeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request, Builder $htmlBuilder)
    {

        if ($request->ajax()) {
            $feeds = Feed::with('groupfeed');
            return Datatables::of($feeds)
                ->addColumn('group', function($feeds) {
                    return $feeds->groupfeed->name; })
                ->addColumn('action', function($feeds){
                    return view('datatable._action',[
                        'model' => $feeds,
                        'edit_url' => route('feeds.edit',$feeds->id),
                        'delete_url' => route('feeds.destroy', $feeds->id),
                        'confirm_message' => 'Are you sure to delete '. $feeds->name . '?'
                    ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'feed_stuff', 'name'=>'feed_stuff', 'title'=>'Feed Staff'])
        ->addColumn(['data' => 'groupfeed.name', 'name'=>'groupfeed.name', 'title'=>'Group Feeds'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('feeds.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        // die();
        $this->validate($request, ['feed_stuff'=> 'required|unique:feeds']);
        $feeds = Feed::create($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $feeds->feed_stuff"
        ]);
        return redirect()->route('feeds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feeds = Feed::find($id);
        return view('feeds.edit')->with(compact('feeds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,['name'=>'required']);
        $feeds = Feed::find($id);
        $feeds->update($request->all());

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $feeds->feed_stuff" ]);
        return redirect()->route('feeds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
