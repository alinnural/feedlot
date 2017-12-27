@extends('layouts.app')

@section('title')
  Tambah Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/tanya-jawab') }}">Tanya Jawab</a></li>
          <li class="active">Tanyakan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ajukan Pertanyaan</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => url('tanyakan'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
              @include('question._form')
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection