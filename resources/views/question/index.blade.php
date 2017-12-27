@extends('layouts.app')

@section('title')
Semua Tanya Jawab {{ $questions->currentPage() }} of {{ $questions->lastPage() }} - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            @if($questions->isEmpty())
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="">
                                <a href="{{ url('tanyakan') }}" class="btn btn-primary pull-right"> Ajukan Pertanyaan</a>
                            </div>
                            <br><br>                       
                            <i>Belum ada pertanyaan dari pengguna</i>
                        </div>
                    </div>
                </div>
            @else
            @endif
            @foreach($questions as $question)
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ url('tanya-jawab') }}/{{$question->id}}" style="font-size:20pt">
                            {{ str_limit($question->title,35) }}
                        </a><br>
                        <hr>
                        <div class="col-md-8">
                            <p>{!! str_limit($question->description,400) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="text-center">    
                    {{ $questions->links() }} 
                </div>
            </div>
        </div>
    </div>
@endsection