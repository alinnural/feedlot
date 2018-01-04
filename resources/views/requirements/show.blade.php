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
            <li class="active">Ternak</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    @role('admin')
                    <div class="btn-group pull-right">                        
                        <a class="btn btn-primary btn-sm" href="{{ route('requirements.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('requirements.edit',$req->id) }}"><i class="fa fa-pencil"></i> Ubah Nama Ternak</a>
                    </div>
                    @else
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('requirements.explore') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    @endrole
                    <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;">Informasi Detail Pakan</h2>
                </div>
                <div class="panel-body">
                    {!! Form::label('animal_type', 'Jenis Ternak', ['class'=>'col-md-3 control-label']) !!} 
                    <div class="description">
                        {!! $req->animal_type !!}
                    </div>
                    @role('admin')
                    <br>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('requirementnutrients.create_id',$req->id) }}"><i class="fa fa-plus"></i> Tambah Nutrient</a>
                    </div>
                    <br>
                    @endrole
                    <hr>
                    <table class="table table-responsive table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Simbol</th>
                                <th class="text-center">Minimum Komposisi</th>
                                <th class="text-center">Maksimum Komposisi</th>
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
                                    <td width="100" class="text-center">{{$nu->min_composition}}</td>
                                    <td width="100" class="text-center">{{$nu->max_composition}}</td>
                                    @role('admin')
                                    <td width="150">
                                        {!! Form::model($nutrients, ['url' => route('requirementnutrients.destroy',$nu->id), 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => 'Apakah Anda yakin akan menghapus '. $nu->nutrient->name . '?' ]) !!}
                                            <a href="{{ route('requirementnutrients.edit',$nu->id) }}" class="btn btn-xs btn-warning">Ubah</a>
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
        @mobile
            @include('layouts.menu-mobile')
        @endmobile
    </div>
</div>
@endsection
