@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/feednutrients') }}">Nutrien Pakan</a></li>
          <li class="active">Ubah Nutrien Pakan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Nutrien Pakan</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($feednutrients, ['url' => route('feednutrients.update', $feednutrients->id),
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('feednutrients._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection