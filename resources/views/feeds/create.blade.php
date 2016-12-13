@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/feeds') }}">Feed Stuff</a></li>
          <li class="active">Create Feeds Stuff</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Create Feed Stuff</h2>
        </div>
        <div class="panel-body">
        {!! Form::open(['url' => route('feeds.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
        @include('feeds._form')
        {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection