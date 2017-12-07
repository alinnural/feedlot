<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
    {!! Form::label('is_public','Dibuka Umum (Public)',['class'=>'col-md-3 control-label'])!!}
    <div class="col-sm-9">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_public','1',true) !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_public','0') !!}
        Tidak
      {!! $errors->first('is_public', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
    {!! Form::label('file', 'File', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
        {!! Form::file('file') !!}
        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{{ url('admin/page') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>