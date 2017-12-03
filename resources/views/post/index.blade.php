@extends('layouts.app')

@section('title')
Semua Berita {{ $posts->currentPage() }} of {{ $posts->lastPage() }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            @foreach($posts as $post)
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('post') }}/{{$post->slug}}" style="font-size:20pt">
                            {{ str_limit($post->title,35) }}
                        </a><br>
                        <span class="date" style="font-size:10pt">{{ $post->published_at->format('M jS Y g:ia') }}</span>
                        <hr>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="
                                @if($feed->image == null)
                                    {{asset('images/no-photo.jpg')}}
                                @else
                                    {{url('img/post')}}/{{$post->page_image}}
                                @endif
                                " alt="{{ $post->title }}" class="img img-responsive">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p>{!! str_limit($post->content_html,400) !!}</p>
                            <a href="{{url('post')}}/{{ $post->slug }}" class="more">Continue reading →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="text-center">    
                    {{ $posts->links() }} 
                </div>
            </div>
        </div>
    </div>
@endsection