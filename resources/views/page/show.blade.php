@extends('layouts.app')

@section('title')
{{ $page->title }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            @if($page->show_slider == true)
                <div class="row">
                    @include('layouts.slider')
                </div>
                @if(!empty($sliders))
                    <hr>
                @endif
            @endif
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="post">
                            <div class="post-content image-caption">
                                <h1 class="post-title">
                                    {!! $page->title !!}

                                    @role('admin')
                                    <div class="pull-right">
                                    <a href="{{ route('page.edit',$page->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                    </div>
                                    @endrole
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
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection