@extends('layouts.app')

@section('title')
  Jawab Pertanyaan - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/question') }}">Tanya Jawab</a></li>
          <li class="active">Jawab Pertanyaan</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Jawab pertanyaan</h2>
          </div>
          <div class="panel-body">
            {!! Form::model($question, ['url' => route('question.update', $question->id),'method' => 'put', 'files'=>'true', 'class'=>'form-horizontal']) !!} 
            		<div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                  {!! Form::label('answer', 'Jawab', ['class'=>'col-md-3 control-label']) !!} 
                  <div class="col-md-9">
                    {!! Form::textarea('answer', null, ['class'=>'form-control','id'=>'summernote']) !!}
                    {!! $errors->first('answer', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-4 col-md-offset-3">
                    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
                    <a href="{{ url('admin/post') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

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