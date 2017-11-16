@extends('layouts.app')

@section('title')
  Editor Halaman - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Dashboard</a></li>
          <li class="active">Editor Halaman</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group pull-right">
                <a class="btn btn-primary btn-sm" href="{{ url('admin/page/create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> Halaman</h2>
          </div>
          <div class="panel-body">
            {!! $html->table(['class'=>'table table-striped table-hover']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {!! $html->scripts() !!}
@endsection