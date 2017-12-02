<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
    {!! Form::label('is_active','Aktif',['class'=>'col-md-3 control-label']) !!}
    <div class="col-sm-9">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_active','1',true) !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_active','0') !!}
        Tidak
      {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    {!! Form::label('photo', 'Foto', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
        {!! Form::file('photo') !!}
        {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
        {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
        <a href="{{ url('admin/slider') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>

@section('scripts')
@endsection