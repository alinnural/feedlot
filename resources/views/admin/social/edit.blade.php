@extends('layouts.app')

@section('title')
  Ubah Sosial Media - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/social') }}">Sosial Media</a></li>
          <li class="active">Ubah Sosial Media</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Sosial Media</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($social, ['url' => route('social.update', $social->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.social._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection