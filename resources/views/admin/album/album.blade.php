@extends('layouts.app')

@section('title')
  Lihat Album - Admin {{ config('configuration.site_name') }}
@endsection

@section('styles')
<style>
.card {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.card {
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 2px;
  background-clip: padding-box;
}
.card span.card-title {
    color: #fff;
    font-size: 24px;
    font-weight: 300;
    text-transform: uppercase;
}

.card .card-image {
  position: relative;
  overflow: hidden;
}
.card .card-image img {
  border-radius: 2px 2px 0 0;
  background-clip: padding-box;
  position: relative;
  z-index: -1;
}
.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 16px;
}
.card .card-content {
  padding: 16px;
  border-radius: 0 0 2px 2px;
  background-clip: padding-box;
  box-sizing: border-box;
}
.card .card-content p {
  margin: 0;
  color: inherit;
}
.card .card-content span.card-title {
  line-height: 48px;
}
.card .card-action {
  border-top: 1px solid rgba(160, 160, 160, 0.2);
  padding: 16px;
}
.card .card-action a {
  color: #ffab40;
  margin-right: 16px;
  transition: color 0.3s ease;
  text-transform: uppercase;
}
.card .card-action a:hover {
  color: #ffd8a6;
  text-decoration: none;
}
</style>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Dashboard</a></li>
          <li class="active">Lihat Album</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="btn-group pull-right">
                <a class="btn btn-primary btn-sm" href="{{ url('admin/album') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;"> {{$album->name}}</h2>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
                <img class="media-object pull-left"alt="{{$album->name}}" src="{{ url('img/cover') }}/{{$album->cover_image}}" width="350px">
              </div>
              <div class="col-md-8">
                <table class="table table-striped table-bordered table-hover">
                  <tr>
                    <td width="200">Nama Album</td>
                    <td width="10">:</td>
                    <td>{{$album->name}}</td>
                  <tr>
                  <tr>
                    <td>Deskripsi Album</td>
                    <td>:</td>
                    <td>{{$album->description}}</td>
                  <tr>
                </table>
                {!! Form::model($album, ['url' => route('album.destroy', $album->id), 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => 'Yakin mau menghapus ' . $album->name . '?' ]) !!}
                    {!! Form::button('<i class="fa fa-trash"></i> Hapus', ['class'=>'btn btn-danger','type'=>'submit']) !!}
                {!! Form::close()!!}
                <hr>
                {!! Form::open(['url' => route('image.store'),'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
                  @include('admin.image._form')
                {!! Form::close() !!}
              </div>
            </div>
            <hr>
            <div class="row">
              @if($album->Photos->count() > 0)
                @foreach($album->Photos as $photo)
                <div class="col-md-3">
                  <div class="thumbnail">
                      <img alt="{{$album->name}}" src="{{ url('img/album') }}/{{$photo->image}}">
                      <div class="caption">
                        {{--<p>{{$photo->description}}</p>
                        Created date:  {{ date("d F Y",strtotime($photo->created_at)) }} at {{ date("g:ha",strtotime($photo->created_at)) }}--}}
                        <hr>
                        {!! Form::model($photo, ['url' => route('image.destroy', $photo->id), 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => 'Yakin mau menghapus ' . $photo->image . '?' ]) !!}
                            {!! Form::button('<i class="fa fa-trash"></i> Hapus Photo', ['class'=>'btn btn-danger btn-block','type'=>'submit']) !!}
                        {!! Form::close()!!}
                        <hr>
                        <div class="row">
                          {!! Form::model($photo, ['url' => route('image.move', $photo->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
                          <div class="col-md-6">
                            <select name="album_id" class="form-control">
                                @foreach($albums as $others)
                                  <option value="{{$others->id}}">{{$others->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">                        
                            <button type="submit" class="btn btn-small btn-info btn-block" onclick="return confirm('Are you sure?')">Pindah</button>
                          </div>
                          {!! Form::close() !!}
                        </div>
                      </div> 
                  </div>
                </div>
                @endforeach
              @else
                <div class="col-md-12">
                  <div class="well"><i>- Tidak Ada Foto -</i></div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection