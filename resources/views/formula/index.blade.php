@extends('layouts.app')

@section('title')
  Formula - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-circle"></i> Pilih Jenis Ransum </h4>
                </div>
                    <div class="panel-body">
                    {!! Form::open(['url' => 'formula/input','class'=>'form-horizontal','id'=>'input']) !!}
                        <div class="form-group">
                            {{ Form::label('var', 'Jenis Ransum', ['class' => 'col-sm-5 control-label']) }}
                            <div class="col-md-7">
                                {!! Form::select('requirement_id', [''=>'']+App\Requirement::pluck('animal_type','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Pilih Jenis Ransum']) !!}
                                {!! $errors->first('requirement_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <input type="submit" class="pull-right btn btn-lg btn-success" value="Lanjut">
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
@endsection