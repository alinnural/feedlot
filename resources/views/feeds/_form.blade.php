<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
    {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('latin_name') ? ' has-error' : '' }}"> 
    {!! Form::label('latin_name', 'Nama Latin', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::text('latin_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('latin_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {!! $errors->has('group_feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('group_feed_id','Group Feed', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::select('group_feed_id', [''=>'']+App\GroupFeed::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Group Feed']) !!}
        {!! $errors->first('group_feed_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  {!! Form::label('description', 'Deskripsi', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-10">
    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'summernote']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
    {!! Form::label('is_public','Dibuka Umum (Public)',['class'=>'col-md-2 control-label'])!!}
    <div class="col-sm-10">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_public','1',true) !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_public','0') !!}
        Tidak
      {!! $errors->first('is_public', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('urutan') ? ' has-error' : '' }}">
    {!! Form::label('urutan', 'Urutan', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::number('urutan',0,['class'=>'form-control']); !!}
        {!! $errors->first('urutan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    {!! Form::label('image', 'Foto', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::file('image') !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-2">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>

@section('scripts')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    CKEDITOR.replace('summernote',{
      skin: 'moono-lisa',
	    preset: 'full',
    });
</script>
@endsection