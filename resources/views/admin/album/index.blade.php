@extends('layouts.app')

@section('title')
  Editor Halaman - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Dashboard</a></li>
          <li class="active">Editor Album</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group pull-right">
                <a class="btn btn-primary btn-sm" href="{{ url('admin/album/create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> Album Foto</h2>
          </div>
          <div class="panel-body">
            @if($albums->count() > 0)
              @foreach($albums as $album)
                <div class="col-lg-3">
                  <div class="thumbnail" style="min-height: 514px;">
                    <img alt="{{$album->name}}" src="{{ url('img/cover/') }}/{{$album->cover_image}}">
                    <div class="caption">
                      <h3>{{$album->name}}</h3>
                      <p>{{$album->description}}</p>
                      <p>{{count($album->Photos)}} image(s).</p>
                      <p>Created date:  {{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</p>
                      <p><a href="{{route('album.show',array('id'=>$album->id))}}" class="btn btn-big btn-default">Show Gallery</a></p>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="col-md-12">
                <div class="well"><i>- Tidak Ada Album -</i></div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection