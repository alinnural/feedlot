@extends('layouts.app')

@section('title')
  Tambah Nutrisi Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/feednutrients') }}">Nutrien Pakan</a></li>
          <li class="active">Tambah Nutrien Pakan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Tambah Nutrien Pakan</h2>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#form" aria-controls="form" role="tab" data-toggle="tab">
                    <i class="fa fa-pencil-square-o"></i> Isi Form
                </a> </li>
                <li role="presentation">
                  <a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">
                    <i class="fa fa-cloud-upload"></i> Upload Excel
                  </a>
              </li> 
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="form">
                <br><br>
                {!! Form::open(['url' => route('feednutrients.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
                  @include('feednutrients._form')
                {!! Form::close() !!}
              </div>             
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection