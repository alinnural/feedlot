<div class="form-group {!! $errors->has('feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('feed_id','Pakan', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::select('feed_id', [''=>'']+App\Feed::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Pakan']) !!}
        {!! $errors->first('feed_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {!! $errors->has('nutrient_id') ? 'has-error' : '' !!}">
    {!! Form::label('nutrient_id','Nutrien', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::select('nutrient_id', [''=>'']+App\Nutrient::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Nutrien']) !!}
        {!! $errors->first('nutrient_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {!! $errors->has('composition') ? 'has-error' : '' !!}">
    {!! Form::label('composition','Komposisi', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {{ Form::number('composition', '',['class' => 'form-control'])}}
        {!! $errors->first('composition', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>