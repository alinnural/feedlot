<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Judul', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}"> 
  {!! Form::label('url', 'Alamat', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('url', null, ['class'=>'form-control']) !!}
    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}"> 
  {!! Form::label('icon', 'Icon', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('icon', null, ['class'=>'form-control']) !!}
    {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}"> 
  {!! Form::label('order', 'Urutan', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('order', null, ['class'=>'form-control']) !!}
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{{ url('admin/post') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>