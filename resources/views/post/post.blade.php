@extends('layouts.app')

@section('title')
{{ $post->title }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 panel panel-default">
            <div class="post">
                <div class="post-content image-caption">
                    <h1 class="post-title">
                        {!! $post->title !!}

                        @role('admin')
                        <div class="pull-right">
                           <a href="{{ route('post.edit',$post->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        @endrole
                    </h1>
                    <div class="meta">
                        <span class="date"><i class="fa fa-calendar"></i> {{ $post->published_at->format('Y-m-d g:ia') }}</span> 
                    </div>
                    <hr>
                    @if($post->page_image != '')
                    <div class="card">
                        <img src="
                        @if($post->page_image == null)
                            {{asset('images/no-photo.jpg')}}
                        @else
                            {{url('img/post')}}/{{$post->page_image}}
                        @endif
                        " alt="{{ $post->title }}" class="img img-responsive" width="350px;" style="float:left; margin-right : 20px; margin-bottom : 20px;">
                    </div>
                    @endif
                    {!! $post->content_html !!}
                </div><!-- /.post-content --> 
                <br>
                <hr>
                @include('layouts.shareit')
            </div>
            <hr>
        </div>
    </div>
@endsection