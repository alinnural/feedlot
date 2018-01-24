@extends('layouts.app')

@section('title')
Semua Tanya Jawab {{ $questions->currentPage() }} of {{ $questions->lastPage() }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                    		<div class="col-md-9">
                    			<input class="form-control" name="search">
                    		</div>
                        <div class="col-md-3">
                            <a href="{{ url('tanyakan') }}"> <i class="fa fa-pencil"></i> Ajukan Pertanyaan</a><br>
                            <a href="{{ url('tanyakan') }}"> <i class="fa fa-search"></i> Periksa Pertanyaan Saya</a>
                        </div>
                        <hr><br><br>
                        <div class="col-md-12">
                        	@if($questions->isEmpty())
                        		<div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-8">
                                        <p>Belum ada pertanyaan</p>
                                    </div>
                                </div>
                            </div>
                        	@else
                        	@endif
                        		@foreach($questions as $question)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="{{ url('tanya-jawab') }}/{{$question->id}}" style="font-size:20pt">
                                            {{ str_limit($question->title,35) }}
                                        </a><br>
                                        <hr>
                                        <p>{!! str_limit($question->description,400) !!}</p>
                                        @if($question->answers()->count() == 0)
                                        		<pre class="bg-light"><i>Belum Ada Jawaban</i></pre>
                                        @else
                                        		<pre class="bg-light"><i></i></pre>
                                        @endif
                                    </div>
                                </div>
                              @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="text-center">    
                    {{ $questions->links() }} 
                </div>
            </div>
        </div>
        @mobile
            @include('layouts.menu-mobile')
        @endmobile
    </div>
@endsection