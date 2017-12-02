@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Input Parameter</div>

                    {!! Form::open(['url' => 'sample/input','class'=>'form-horizontal']) !!}
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
