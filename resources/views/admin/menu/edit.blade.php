@extends('layouts.app')

@section('title')
  Edit Menu - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/menu') }}">Menu</a></li>
          <li class="active">Ubah Menu</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Menu</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($menu, ['url' => route('menu.update', $menu->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.menu._form_edit')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection