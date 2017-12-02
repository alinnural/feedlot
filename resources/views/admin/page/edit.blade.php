@extends('layouts.app')

@section('title')
  Ubah Halaman - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/page') }}">Halaman</a></li>
          <li class="active">Ubah Halaman</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Halaman</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($page, ['url' => route('page.update', $page->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.page._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection