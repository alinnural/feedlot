@section('styles')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
  {!! Form::label('title', 'Judul', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}"> 
  {!! Form::label('subtitle', 'Sub Judul', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
    {!! $errors->first('substitle', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
  {!! Form::label('content', 'Konten', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'summernote']) !!}
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('page_image') ? ' has-error' : '' }}">
    {!! Form::label('page_image', 'Foto', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
        {!! Form::file('page_image') !!}
        {!! $errors->first('page_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
    {!! Form::label('meta_description', 'Meta Deskripsi', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
         {!! Form::text('meta_description', null, ['class'=>'form-control']) !!}
        {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
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