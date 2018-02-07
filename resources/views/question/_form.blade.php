<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
    {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('email', 'email', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Judul', ['class'=>'col-md-2 control-label']) !!} 
    <div class="col-md-10">
        {!! Form::text('title',null,['class'=>'form-control']); !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  {!! Form::label('description', 'Deskripsi', ['class'=>'col-md-2 control-label']) !!} 
  <div class="col-md-10">
    {!! Form::textarea('description', null, ['class'=>'form-control','id'=>'summernote']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
    <div class="col-md-2">&nbsp;</div>
        <div class="col-md-10">
            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
        </div>
    </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-2">
    {!! Form::submit('Ajukan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    CKEDITOR.replace('summernote',{
      skin: 'moono-lisa',
	    preset: 'full',
    });
</script>
@endsection