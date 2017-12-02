@extends('layouts.app')

@section('title')
    {{$groupfeed->name}} Grup Pakan - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            @foreach($feeds as $feed)
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{ url('feeds/detail') }}/{{$feed->id}}" style="font-size:20pt">
                        {{ str_limit($feed->name,35) }}
                    </a><br>
                    <span class="date" style="font-size:10pt">
                    </span>
                    <hr>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{url('img/feeds')}}/{{$feed->image}}" alt="{{ $feed->name }}" class="img img-responsive">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p>{!! str_limit($feed->description,400) !!}</p>
                        <a href="{{url('feeds/detail')}}/{{ $feed->id }}" class="more">Continue reading →</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="text-center">    
                    {{ $feeds->links() }} 
                </div>
            </div>
        </div>
    </div>
@endsection

