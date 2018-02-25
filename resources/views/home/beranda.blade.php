@extends('layouts.app')

@section('title', config('configuration.site_name'))

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="">
                @include('layouts.slider')
            </div>
            @if(!empty($sliders))
                <hr>
            @endif

            @foreach($posts as $post)
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="{{ url('post') }}/{{$post->slug}}" style="font-size:20pt;text-decoration:none">
                                {{ str_limit($post->title,35) }}
                            </a><br>
                            <span class="date" style="font-size:10pt"><i class="fa fa-calendar"></i> {{ $post->published_at->format('Y-m-d g:ia') }}</span>
                            <hr>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="
                                    @if($post->page_image == null)
                                        {{asset('images/no-photo.jpg')}}
                                    @else
                                        {{url('img/post')}}/{{$post->page_image}}
                                    @endif" alt="{{ $post->title }}" class="img img-responsive">
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
                <div class="">
                    <div class="text-center">    
                        {{ $posts->links() }} 
                    </div>
                </div>
        </div>
        @mobile
            @include('layouts.menu-mobile')
        @endmobile
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow"); 
    });
</script>
@endsection