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
                    <h1 class="post-title">
                        {!! $page->title !!}

                        @if (Auth::check())
                        <div class="pull-right">
                           <a href="{{ route('page.edit',$page->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        @endif
                    </h1>
                    <div class="meta">
                        <span class="date"><i class="fa fa-calendar"></i> {{ $page->created_at->format('Y-m-d g:ia') }}</span> 
                        
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
        </div>
    </div>
@endsection