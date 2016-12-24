<div class="form-group{{ $errors->has('animal_type') ? ' has-error' : '' }}"> 
{!! Form::label('animal_type', 'Animal Type', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('animal_type', null, ['class'=>'form-control','placeholder'=>'animal type']) !!}
    {!! $errors->first('animal_type', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('finish') ? ' has-error' : '' }}"> 
{!! Form::label('finish', 'Finish Weight Body', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('finish', null, ['class'=>'form-control','placeholder'=>'Finish Weight Body']) !!}
    {!! $errors->first('finish', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('current') ? ' has-error' : '' }}"> 
{!! Form::label('current', 'Current Weight Body', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('current', null, ['class'=>'form-control','placeholder'=>'Current Weight Body']) !!}
    {!! $errors->first('current', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('adg') ? ' has-error' : '' }}"> 
{!! Form::label('adg', 'Average Daily Gain', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('adg', null, ['class'=>'form-control','placeholder'=>'Average Daily Gain']) !!}
    {!! $errors->first('adg', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('dmi') ? ' has-error' : '' }}"> 
{!! Form::label('dmi', 'Dry Mater Intake', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('dmi', null, ['class'=>'form-control','placeholder'=>'Dry Mater Intake']) !!}
    {!! $errors->first('dmi', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('tdn') ? ' has-error' : '' }}"> 
{!! Form::label('tdn', 'Total Digestible Nutrient', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('tdn', null, ['class'=>'form-control','placeholder'=>'Total Digestible Nutrient']) !!}
    {!! $errors->first('tdn', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('nem') ? ' has-error' : '' }}"> 
{!! Form::label('nem', 'Net Energy Requirement for Maintenance', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('nem', null, ['class'=>'form-control','placeholder'=>'Net Energy Requirement for Maintenance']) !!}
    {!! $errors->first('nem', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('neg') ? ' has-error' : '' }}"> 
{!! Form::label('neg', 'Net Energy Requirement for Gain', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('neg', null, ['class'=>'form-control','placeholder'=>'Net Energy Requirement for Maintenance']) !!}
    {!! $errors->first('neg', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}"> 
{!! Form::label('cp', 'Crude Protein Requirement', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('cp', null, ['class'=>'form-control','placeholder'=>'Crude Protein Requirement']) !!}
    {!! $errors->first('cp', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('ca') ? ' has-error' : '' }}"> 
{!! Form::label('ca', 'Total dietary Requirement of Calcium', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('ca', null, ['class'=>'form-control','placeholder'=>'Total dietary Requirement of Calcium']) !!}
    {!! $errors->first('ca', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('p') ? ' has-error' : '' }}"> 
{!! Form::label('p', 'Total dietary Requirement of Phosporus', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('p', null, ['class'=>'form-control','placeholder'=>'Total dietary Requirement of Phosporus']) !!}
    {!! $errors->first('p', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('month_pregnant') ? ' has-error' : '' }}"> 
{!! Form::label('month_pregnant', 'Month Pregnant', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('month_pregnant', null, ['class'=>'form-control','placeholder'=>'Month Pregnant']) !!}
    {!! $errors->first('month_pregnant', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('month_calvin') ? ' has-error' : '' }}"> 
{!! Form::label('month_calvin', 'Month Calvin', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('month_calvin', null, ['class'=>'form-control','placeholder'=>'Month Calvin']) !!}
    {!! $errors->first('month_calvin', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('peak_milk') ? ' has-error' : '' }}"> 
{!! Form::label('peak_milk', 'Peak Milk', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('peak_milk', null, ['class'=>'form-control','placeholder'=>'Peak Milk']) !!}
    {!! $errors->first('peak_milk', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('current_milk') ? ' has-error' : '' }}"> 
{!! Form::label('current_milk', 'Current Milk', ['class'=>'col-md-3 control-label']) !!} 
<div class="col-md-8">
    {!! Form::text('current_milk', null, ['class'=>'form-control','placeholder'=>'Current Milk']) !!}
    {!! $errors->first('current_milk', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>