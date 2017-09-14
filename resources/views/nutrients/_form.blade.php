<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
    {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}"> 
    {!! Form::label('abbreviation', 'Abbreviation', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('abbreviation', null, ['class'=>'form-control']) !!}
        {!! $errors->first('abbreviation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {!! $errors->has('unit_id') ? 'has-error' : '' !!}">
    {!! Form::label('unit_id','Unit', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::select('unit_id', [''=>'']+App\Unit::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Pilih Unit']) !!}
        {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>  