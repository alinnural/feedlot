<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
{!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} <div class="col-md-4">
{!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
{!! Form::label('email', 'Email', ['class'=>'col-md-3 control-label']) !!} <div class="col-md-4">
{!! Form::email('email', null, ['class'=>'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{{ url('admin/member') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>