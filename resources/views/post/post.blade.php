@extends('layouts.app')

@section('title')
{{ $post->title }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="post">
                <div class="post-content image-caption">
                    <h1 class="post-title">{!! $post->title !!}</h1>
                    <div class="meta">
                        <span class="date">{{ $post->published_at->format('M jS Y g:ia') }}</span> 
                    </div>
                    <hr>
                    <div class="card">
                        @if($post->page_image == '')
                            <img src="http://5uoqf25iuenklnzqg8khs17s.wpengine.netdna-cdn.com/wp-content/uploads/2014/10/d61-1024x525.jpg" class="attachment-large size-large wp-post-image" asizes="(max-width: 1024px) 100vw, 1024px">		</a>
                        @else
                            <img src="{{url('img/post')}}/{{$post->page_image}}" alt="{{ $post->title }}" class="img img-responsive" width="350px;" style="float:left; margin-right : 20px; margin-bottom : 20px;">
                        @endif
                    </div>
                    {!! $post->content_html !!}
                </div><!-- /.post-content --> 
                <br>
                <hr>
                @include('layouts.shareit')
            </div>
            <hr>
            @include('layouts.disqus')    
        </div>
    </div>
@endsection