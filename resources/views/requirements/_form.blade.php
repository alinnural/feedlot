<div class="form-group{{ $errors->has('animal_type') ? ' has-error' : '' }}"> 
{!! Form::label('animal_type', 'Animal Type', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('animal_type', null, ['class'=>'form-control','placeholder'=>'animal type']) !!}
    {!! $errors->first('animal_type', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('current') ? ' has-error' : '' }}"> 
{!! Form::label('current', 'Current Weight Body', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('current', null, ['class'=>'form-control','placeholder'=>'Current Weight Body']) !!}
    {!! $errors->first('current', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('adg') ? ' has-error' : '' }}"> 
{!! Form::label('adg', 'Average Daily Gain', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('adg', null, ['class'=>'form-control','placeholder'=>'Average Daily Gain']) !!}
    {!! $errors->first('adg', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>