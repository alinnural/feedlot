@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
              @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/groupfeeds') }}">Group Feeds</a></li>
          <li class="active">Create Group Feeds</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Create GroupFeeds</h2>
        </div>
        <div class="panel-body">
        {!! Form::open(['url' => route('groupfeeds.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
        @include('groupfeeds._form')
        {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection