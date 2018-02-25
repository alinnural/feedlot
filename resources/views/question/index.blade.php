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
            		<ul class="breadcrumb">
                  <li><a href="{{ url('/home') }}">Dashboard</a></li>
                  <li><a href="{{ url('/tanya-jawab') }}">Tanya Jawab</a></li>
                </ul>
                <div class="panel panel-default">
                		<div class="panel-header">
                			&nbsp;
                		</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('tanya.jawab.search'), 'method' => 'get', 'class'=>'form-horizontal']) !!} 
                          	<div class="col-md-9">
                        			<input class="form-control" name="keyword" id="search" placeholder="Ketik kata kunci yang akan dicari lalu tekan ENTER" >
                        		</div>
                        {!! Form::close() !!}
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
                                    @if($question->answers()->count() > 0)
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <a href="{{ url('tanya-jawab') }}/{{$question->id}}" style="font-size:20pt">
                                                    {{ str_limit($question->title,35) }}
                                                </a><br>
                                                <hr>
                                                <p>{!! str_limit($question->description,400) !!}</p>
                                                <pre class="bg-light">
                                                    <i>Pakar : <b>{{ $question->answers()->first()->user()->first()->name }}({{ $question->answers()->first()->user()->first()->email }})</b> 
                                                    <br>{!! $question->answers()->first()->answer !!}</i>
                                                </pre>
                                            </div>
                                        </div>
                                    @endif
                              @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">    
                            {{ $questions->links() }} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @mobile
            @include('layouts.menu-mobile')
        @endmobile
    </div>
@endsection

@section('scripts')
<script>
$("#input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#formsearch").submit();
    }
});
</script>
@endsection
