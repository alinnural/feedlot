<div class="form-group{{ $errors->has('animal_type') ? ' has-error' : '' }}"> 
{!! Form::label('animal_type', 'Jenis Ternak', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('animal_type', null, ['class'=>'form-control','placeholder'=>'animal type']) !!}
    {!! $errors->first('animal_type', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>