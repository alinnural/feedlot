
@extends('layouts.app')

@section('styles')
<style>
.imgHolder {
    position: relative;
}
.imgHolder span {
    position: absolute;
    right: 10px;
    top: 10px;
}
</style>
@endsection
@section('title')
  Editor Slider - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Dashboard</a></li>
          <li class="active">Editor Slider</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group pull-right">
                @if(count($slider) > 0)
                        <a href="{{ url('/admin/slider/create') }}" class="btn btn-primary btn-sm" role="button">
                        <i class="fa fa-pencil"></i> Tambah Slider Baru
                        </a>
                @endif
            </div>
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> Slider</h2>
          </div>
          <div class="panel-body">
            <div class="row">
                @forelse($slider as $slide)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="imgHolder">
                                <img src="{{asset('img/slider/'.$slide->photo)}}" style="width: 155px; height: 120px;"  />
                                <span>
                                    @if($slide->is_active == 1)
                                        <label class="label label-success">aktif</label>
                                    @else
                                        <label class="label label-danger">non-aktif</label>
                                    @endif
                                    <br><br>
                                    {!! Form::open(['url'=>'/admin/slider/'.$slide->id, 'class'=>'pull-left']) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'onclick'=>'return confirm(\'Are you sure?\')']) !!}
                                    {!! Form::close() !!}
                                </span>
                            </div>
                            <div class="caption">
                                <h3>{{$slide->name}}</h3>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>Tidak Ada Foto yang, <a href="{{ url('/admin/slider/create') }}" class="btn btn-primary">Tambah Foto</a></p>
                    </div>
                @endforelse
            </div>
            <div align="center">{!! $slider->render() !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection