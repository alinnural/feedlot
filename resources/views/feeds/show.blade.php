@extends('layouts.app')

@section('title')
  Detail Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9 ">
            <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="active">Pakan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    @role('admin')
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="{{ route('feeds.edit',$feed->id) }}"><i class="fa fa-pencil"></i> Ubah Pakan</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('feeds.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    @else
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('feeds.explore') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    @endrole
                    <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;">Informasi Detail Pakan</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <image src="
                            @if($feed->image == null)
                                {{asset('images/no-photo.jpg')}}
                            @else
                                {{url('img/feeds')}}/{{$feed->image}}
                            @endif" class="img img-thumbnail" style="width: 300px; height: 170px;">
                        </div>
                        <div class="col-md-8">
                            <div class="row form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama</label>
                                    <div class="col-md-9">
                                        {{$feed->name}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Latin</label>
                                    <div class="col-md-9">
                                        <i>{{$feed->latin_name}}</i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Local</label>
                                    <div class="col-md-9">
                                        {{$feed->local_name}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Minimal</label>
                                    <div class="col-md-9">
                                        {{$feed->min}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Maksimal</label>
                                    <div class="col-md-9">
                                        {{$feed->max}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Harga</label>
                                    <div class="col-md-9">
                                        {{$feed->price}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="description">
                        {!! $feed->description !!}
                    </div>
                    <hr> 
                    <h4>
                        <b>Komposisi Nutrien Bahan Pakan</b>
                        @role('admin')
                        <div class="btn-group pull-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('feednutrients.create_id',$feed->id) }}"><i class="fa fa-plus"></i> Tambah Nutrient</a>
                        </div>
                        @endrole
                    </h4>
                    <hr>
                    <table class="table table-responsive table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Simbol</th>
                                <th class="text-center">Komposisi</th>
                                @role('admin')
                                    <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($nutrients as $nu)
                                <tr>
                                    <td width="50">{{$no++}}</td>
                                    <td>{{$nu->nutrient->name}}</td>
                                    <td width="100" class="text-center">{{$nu->nutrient->abbreviation}}</td>
                                    <td width="100" class="text-center">{{$nu->composition}}</td>
                                    @role('admin')
                                    <td width="150">
                                        {!! Form::model($nutrients, ['url' => route('feednutrients.destroy',$nu->id), 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => 'Apakah Anda yakin akan menghapus '. $nu->nutrient->name . '?' ]) !!}
                                            <a href="{{ route('feednutrients.edit',$nu->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                                            {!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
                                        {!! Form::close()!!}
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
