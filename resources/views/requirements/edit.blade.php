@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/requirements') }}"> Requirement</a></li>
          <li class="active">Edit Requirement</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Edit Requirement</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($requirements, ['url' => route('requirements.update', $requirements->id),
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('requirements._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection