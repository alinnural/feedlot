@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
              @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/units') }}">Units</a></li>
          <li class="active">Tambah Units</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Tambah Units</h2>
        </div>
        <div class="panel-body">
        {!! Form::open(['url' => route('units.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
        @include('units._form')
        {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection