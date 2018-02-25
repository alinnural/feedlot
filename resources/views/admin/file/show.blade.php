@extends('layouts.app')

@section('title')
  Show File - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Dashboard</a></li>
          <li class="active">Lihat File</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group pull-right">
                <a class="btn btn-default btn-sm" href="{{ route('file.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> Lihat File</h2>
          </div>
          <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3">Nama</label> 
                    <div class="col-md-9">
                        {{$file->name}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Jenis File</label> 
                    <div class="col-md-9">
                        {{$file->extension}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Link File</label> 
                    <div class="col-md-9">
                        <a href="{{asset('file')}}/{{$file->file}}" target="_blank">{{asset('file')}}/{{$file->file}}</a>
                    </div>
                </div>
                @if($file->extension == 'pdf')
                <div class="form-group">
                    <label class="control-label col-md-3">Sematkan</label> 
                    <div class="col-md-9">
                        <textarea class="form-control"><iframe src="{{asset('file')}}/{{$file->file}}" width="100%" height="500"></iframe></textarea>
                    </div>
                </div>
                @endif
            </div>
            @if($file->extension == 'pdf')
            <iframe src="{{asset('file')}}/{{$file->file}}" width="100%" height="500"></iframe>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection