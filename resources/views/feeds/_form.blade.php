<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
    {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('latin_name') ? ' has-error' : '' }}"> 
    {!! Form::label('latin_name', 'Nama Latin', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {!! Form::text('latin_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('latin_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {!! $errors->has('group_feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('group_feed_id','Group Feed', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {!! Form::select('group_feed_id', [''=>'']+App\GroupFeed::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Group Feed']) !!}
        {!! $errors->first('group_feed_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  {!! Form::label('description', 'Deskripsi', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-8">
    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'summernote']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    {!! Form::label('image', 'Foto', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-9">
        {!! Form::file('image') !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>

@section('styles')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@endsection