<div class="form-group {!! $errors->has('requirement_id') ? 'has-error' : '' !!}">
    {!! Form::label('requirement_id','Ternak', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        <input type="text" name="name" value="{{$requirement->animal_type}}" readonly class="form-control">
        <input type="hidden" name="requirement_id" value="{{$requirement->id}}" readonly>
    </div>
</div>
<div class="form-group {!! $errors->has('nutrient_id') ? 'has-error' : '' !!}">
    {!! Form::label('nutrient_id','Nutrien', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {!! Form::select('nutrient_id', [''=>'']+App\Nutrient::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Nutrien']) !!}
        {!! $errors->first('nutrient_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {!! $errors->has('min_composition') ? 'has-error' : '' !!}">
    {!! Form::label('min_composition','Minimum Komposisi', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {{ Form::text('min_composition', null,['class' => 'form-control'])}}
        {!! $errors->first('min_composition', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group {!! $errors->has('max_composition') ? 'has-error' : '' !!}">
    {!! Form::label('max_composition','Maksimum Komposisi', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-8">
        {{ Form::text('max_composition', null,['class' => 'form-control'])}}
        {!! $errors->first('max_composition', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>