<div class="form-group{{ $errors->has('feed_stuff') ? ' has-error' : '' }}"> 
    {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {!! $errors->has('group_feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('group_feed_id','Group Feed', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::select('group_feed_id', [''=>'']+App\GroupFeed::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Group Feed']) !!}
        {!! $errors->first('group_feed_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>