@extends('layouts.app')

@section('title')
  Ubah Pengaturan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/setting') }}">Pengaturan</a></li>
          <li class="active">Ubah Pengaturan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Pengaturan</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($setting, ['url' => route('setting.update', $setting->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.setting._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection