@extends('layouts.app')

@section('title')
  Tambah Pengaturan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/setting') }}">Pengaturan</a></li>
          <li class="active">Tambah Pengaturan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Tambah Pengaturan</h2>
        </div>
        <div class="panel-body">
        {!! Form::open(['url' => route('setting.store'),'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
        @include('admin.setting._form')
        {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection