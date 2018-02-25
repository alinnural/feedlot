@extends('layouts.app')
@section('title')
  Ubah Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/feeds') }}">Feeds Stuff</a></li>
          <li class="active">Edit Feeds Stuff</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Edit Feeds Stuff</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($feeds, ['url' => route('feeds.update', $feeds->id),'files'=>'true',
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('feeds._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection