@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/authors') }}">Group Feeds</a></li>
          <li class="active">Edit Group Feeds</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Edit Group Feeds</h2>
            </div>
            <div class="panel-body">
            {!! Form::model($group, ['url' => route('groupfeeds.update', $group->id),
            'method'=>'put', 'class'=>'form-horizontal']) !!} 
            @include('groupfeeds._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection