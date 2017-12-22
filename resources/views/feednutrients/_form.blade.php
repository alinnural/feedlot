<div class="form-group {!! $errors->has('feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('feed_id','Pakan', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        <input type="text" name="name" value="{{$feed->name}}" readonly class="form-control">
        <input type="hidden" name="feed_id" value="{{$feed->id}}" readonly>
    </div>
</div>
<div class="form-group {!! $errors->has('nutrient_id') ? 'has-error' : '' !!}">
    {!! Form::label('nutrient_id','Nutrien', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {!! Form::select('nutrient_id', [''=>'']+App\Nutrient::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Nutrien']) !!}
        {!! $errors->first('nutrient_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {!! $errors->has('composition') ? 'has-error' : '' !!}">
    {!! Form::label('composition','Komposisi', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {{ Form::text('composition', '',['class' => 'form-control'])}}
        {!! $errors->first('composition', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>