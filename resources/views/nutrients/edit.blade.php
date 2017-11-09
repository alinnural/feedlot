@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/nutrients') }}">Nutrient</a></li>
          <li class="active">Ubah Nutrient</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Nutrient</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($nutrients, ['url' => route('nutrients.update', $nutrients->id),
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('nutrients._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection