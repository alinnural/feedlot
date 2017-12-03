@extends('layouts.app')

@section('title')
{{ $page->title }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 panel panel-default">
            <div class="post">
                <div class="post-content image-caption">
                    <h1 class="post-title">{!! $page->title !!}</h1>
                    <div class="meta">
                        <span class="date">{{ $page->created_at->format('M jS Y g:ia') }}</span> 
                    </div>
                    <hr>
                    @if($page->image != '')
                        <div class="card">
                            <img src="
                            @if($page->image == null)
                                {{asset('images/no-photo.jpg')}}
                            @else
                                {{url('img/page')}}/{{$page->image}}
                            @endif" alt="{{ $page->title }}" class="img img-responsive" width="350px;" style="float:left; margin-right : 20px; margin-bottom : 20px;">
                        </div>
                    @endif
                    {!! $page->content !!}
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