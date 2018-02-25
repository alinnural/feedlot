<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(config('configuration.paging_news'));

        return view('post.index')
            ->with(compact('posts'));
    }

    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $popularpost = Post::where('published_at','<=',Carbon::now())
                ->orderBy('published_at','desc')
                ->paginate(config('configuration.paging_news'));
        
        return view('post.post')
                ->withPost($post)
                ->with(compact('popularpost'));
    }
}
