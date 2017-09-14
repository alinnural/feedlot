<div class="form-group{{ $errors->has('animal_type') ? ' has-error' : '' }}"> 
{!! Form::label('animal_type', 'Animal Type', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('animal_type', null, ['class'=>'form-control','placeholder'=>'animal type']) !!}
    {!! $errors->first('animal_type', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('current_weight') ? ' has-error' : '' }}"> 
{!! Form::label('current_weight', 'Current Weight Body', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('current_weight', null, ['class'=>'form-control','placeholder'=>'Current Weight Body']) !!}
    {!! $errors->first('current_weight', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('average_daily_gain') ? ' has-error' : '' }}"> 
{!! Form::label('average_daily_gain', 'Average Daily Gain', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('average_daily_gain', null, ['class'=>'form-control','placeholder'=>'Average Daily Gain']) !!}
    {!! $errors->first('average_daily_gain', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>