<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
{!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4">
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nama']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}"> 
{!! Form::label('symbol', 'Simbol', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-4">
    {!! Form::text('symbol', null, ['class'=>'form-control','placeholder'=>'Simbol']) !!}
    {!! $errors->first('symbol', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>