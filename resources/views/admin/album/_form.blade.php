<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  {!! Form::label('description', 'Deskripsi', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'summernote']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('cover_image') ? ' has-error' : '' }}">
    {!! Form::label('cover_image', 'Foto Cover', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
        {!! Form::file('cover_image') !!}
        {!! $errors->first('cover_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
        {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
        <a href="{{ url('admin/album') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>