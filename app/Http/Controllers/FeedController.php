<?php namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Feed;
use Request;
 
class FeedController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
 
		$feeds = Feed::all();
		return $feeds;
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$feed = Feed::create(Request::all());
		return $feed;
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$feed = Feed::find($id);
		$feed->done = Request::input('done');
		$feed->save();
 
		return $todo;
	}
 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Feed::destroy($id);
	}
 
}