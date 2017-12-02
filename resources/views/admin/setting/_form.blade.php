@section('styles')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}"> 
  {!! Form::label('kode', 'Kode', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('code', null, ['class'=>'form-control']) !!}
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}"> 
  {!! Form::label('value', 'Isi', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('value', null, ['class'=>'form-control']) !!}
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-4">
    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{{ url('admin/post') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@endsection