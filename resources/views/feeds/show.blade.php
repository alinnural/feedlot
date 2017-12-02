@extends('layouts.app')

@section('title')
  Detail Pakan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="active">Pakan</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a class="btn btn-default btn-sm" href="{{ route('feeds.edit',$feed->id) }}"><i class="fa fa-pencil"></i> Ubah Pakan</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('feeds.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;">Informasi Detail Pakan</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <image src="{{asset('img/feeds/'.$feed->image)}}" class="img img-thumbnail" style="width: 200px; height: 200px;">
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
                                    <label class="col-md-3 control-label">Deskripsi</label>
                                    <div class="col-md-9">
                                        {{$feed->description}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('feednutrients.create_id',$feed->id) }}"><i class="fa fa-plus"></i> Tambah Nutrient</a>
                    </div>
                    &nbsp;
                    <hr>
                    <div class="row">
                        <table class="table table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Simbol</th>
                                    <th>Komposisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($nutrients as $nu)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$nu->nutrient->name}}</td>
                                        <td>{{$nu->nutrient->abbreviation}}</td>
                                        <td>{{$nu->composition}}</td>
                                        <td width="150">
                                            {!! Form::model($nutrients, ['url' => route('feednutrients.destroy',$nu->id), 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => 'Apakah Anda yakin akan menghapus '. $nu->nutrient->name . '?' ]) !!}
                                                <a href="{{ route('feednutrients.edit',$nu->id) }}" class="btn btn-xs btn-warning">Ubah</a>
                                                {!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
                                            {!! Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
