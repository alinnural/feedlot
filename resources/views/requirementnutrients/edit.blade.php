@extends('layouts.app')

@section('title')
  Ubah Nutrisi Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/requirementnutrients') }}">Nutrien Ternak</a></li>
          <li class="active">Ubah Nutrien Ternak</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Nutrien Ternak</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($requirementnutrients, ['url' => route('requirementnutrients.update', $requirementnutrients->id),
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('requirementnutrients._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection