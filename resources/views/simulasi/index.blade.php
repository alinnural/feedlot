@extends('layouts.app')

@section('title')
  Pnput Parameter Simulasi Linier Programming - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Input Parameter</div>

                    {!! Form::open(['url' => 'simulasi/input','class'=>'form-horizontal']) !!}
                    <div class="panel-body">    
                        <div class="form-group">
                            {!! Form::label('var', 'Berapa Variabel?', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::number('var', 'value',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('cons', 'Berapa Constraint?', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::number('cons', 'value',['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                {!! Form::submit('Lanjut',['class'=>'btn btn-primary']) !!}
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
