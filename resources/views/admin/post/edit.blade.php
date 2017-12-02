@extends('layouts.app')

@section('title')
  Ubah Berita - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/post') }}">Berita</a></li>
          <li class="active">Ubah Berita</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Ubah Berita</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($post, ['url' => route('post.update', $post->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                @include('admin.post._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection