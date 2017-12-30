@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/groupfeeds') }}"> Requirements</a></li>
          <li class="active">Create Requirement</li>
        </ul>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title">Create Requirement</h2>
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
                {!! Form::open(['url' => route('requirements.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!} 
                  @include('requirements._form')
                {!! Form::close() !!}
              </div>
             <div role="tabpanel" class="tab-pane" id="upload">
                <br><br>
                {!! Form::open(['url' => route('import.requirements'),
                'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
                @include('requirements._import')
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      @mobile
          @include('layouts.menu-mobile')
      @endmobile
    </div>
  </div>
@endsection