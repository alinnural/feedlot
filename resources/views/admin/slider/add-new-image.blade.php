
@extends('layouts.app')

@section('title')
  Editor Slider - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Dashboard</a></li>
          <li class="active">Editor Slider</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> Tambah Slider</h2>
          </div>
          <div class="panel-body">
            {!! Form::open(['url' => route('slider.store'),'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
            @include('admin.slider._form')
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection