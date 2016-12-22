<div class="form-group{{ $errors->has('feed_stuff') ? ' has-error' : '' }}"> 
    {!! Form::label('feed_stuff', 'Feed Name', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::text('feed_stuff', null, ['class'=>'form-control']) !!}
        {!! $errors->first('feed_stuff', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {!! $errors->has('group_feed_id') ? 'has-error' : '' !!}">
    {!! Form::label('group_feed_id','Group Feed', ['class'=>'col-md-3 control-label']) !!} 
    <div class="col-md-4">
        {!! Form::select('group_feed_id', [''=>'']+App\GroupFeed::pluck('name','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Choose Group Feed']) !!}
        {!! $errors->first('group_feed_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="col-md-4">
    <div class="form-group{{ $errors->has('dry_matter') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('dry_matter', 'Dry Matter (DM)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('dry_matter', null, ['class'=>'form-control']) !!}
                {!! $errors->first('dry_matter', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('mineral') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('mineral', 'Mineral (Ash)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('mineral', null, ['class'=>'form-control']) !!}
                {!! $errors->first('mineral', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('organic_matter') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('organic_matter', 'Organic Matter (OM)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('organic_matter', null, ['class'=>'form-control']) !!}
                {!! $errors->first('organic_matter', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('lignin') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('lignin', 'Lignin (Lig)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('lignin', null, ['class'=>'form-control']) !!}
                {!! $errors->first('lignin', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('neutral_detergent_fiber') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('neutral_detergent_fiber', 'Neutral Detergent Fiber (NDF)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('neutral_detergent_fiber', null, ['class'=>'form-control']) !!}
                {!! $errors->first('neutral_detergent_fiber', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('ether_extract') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('ether_extract', 'Ether Extract (EE)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('ether_extract', null, ['class'=>'form-control']) !!}
                {!! $errors->first('ether_extract', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('nonfiber_carbohydrates') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('nonfiber_carbohydrates', 'Non Fiber Carbohydrates (NFC)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('nonfiber_carbohydrates', null, ['class'=>'form-control']) !!}
                {!! $errors->first('nonfiber_carbohydrates', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('total_digestible_nutrients') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('total_digestible_nutrients', 'Total Digestible Nutrients (TDN)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('total_digestible_nutrients', null, ['class'=>'form-control']) !!}
                {!! $errors->first('total_digestible_nutrients', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('metabolizable_energy') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('metabolizable_energy', 'Metabolizable Energy (ME)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('metabolizable_energy', null, ['class'=>'form-control']) !!}
                {!! $errors->first('metabolizable_energy', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('rumen_degradable_cp') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_degradable_cp', 'Rumen Degradable (RDP) %CP', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_degradable_cp', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_degradable_cp', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('rumen_degradable_dm') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_degradable_dm', 'Rumen Degradable (RDP) %DM', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_degradable_dm', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_degradable_dm', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has('rumen_undegradable_cp') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_undegradable_cp', 'Rumen Undegradable (RUP) %CP', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_undegradable_cp', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_undegradable_cp', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('rumen_undegradable_dm') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_undegradable_dm', 'Rumen Undegradable (RUP) %DM', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_undegradable_dm', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_undegradable_dm', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('rumen_soluble') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_soluble', 'Rumen Soluble Protein Fraction A(CP A)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_soluble', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_soluble', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('rumen_insoluble') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('rumen_insoluble', 'Rumen Unsoluble Protein Fraction B (CP B)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('rumen_insoluble', null, ['class'=>'form-control']) !!}
                {!! $errors->first('rumen_insoluble', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('degradation_rate') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('degradation_rate', 'Degradation rate of Fraction B (CP kd)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('degradation_rate', null, ['class'=>'form-control']) !!}
                {!! $errors->first('degradation_rate', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('crude_protein') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('crude_protein', 'Crude Protein (CP)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('crude_protein', null, ['class'=>'form-control']) !!}
                {!! $errors->first('crude_protein', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('metabolizable_protein') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('metabolizable_protein', 'Metabolizable Protein (MP)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('metabolizable_protein', null, ['class'=>'form-control']) !!}
                {!! $errors->first('metabolizable_protein', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('calcium') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('calcium', 'Calcium (Ca)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('calcium', null, ['class'=>'form-control']) !!}
                {!! $errors->first('calcium', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('phosphorus') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('phosphorus', 'Phosphorus (P)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('phosphorus', null, ['class'=>'form-control']) !!}
                {!! $errors->first('phosphorus', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('magnesium') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('magnesium', 'Magnesium (Mg)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('magnesium', null, ['class'=>'form-control']) !!}
                {!! $errors->first('magnesium', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('potassium') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('potassium', 'Potassium (K)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('potassium', null, ['class'=>'form-control']) !!}
                {!! $errors->first('potassium', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group{{ $errors->has('sodium') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('sodium', 'Sodium (Na)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('sodium', null, ['class'=>'form-control']) !!}
                {!! $errors->first('sodium', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('sulfur') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('sulfur', 'Sulfur (S)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('sulfur', null, ['class'=>'form-control']) !!}
                {!! $errors->first('sulfur', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('cobalt') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('cobalt', 'Cobalt (Co)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('cobalt', null, ['class'=>'form-control']) !!}
                {!! $errors->first('cobalt', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('copper') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('copper', 'Copper (Cu)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('copper', null, ['class'=>'form-control']) !!}
                {!! $errors->first('copper', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('iodine') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('iodine', 'Iodine (I)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('iodine', null, ['class'=>'form-control']) !!}
                {!! $errors->first('iodine', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('manganese') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('manganese', 'manganese (Mn)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('manganese', null, ['class'=>'form-control']) !!}
                {!! $errors->first('manganese', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('selenium') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('selenium', 'selenium (Se)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('selenium', null, ['class'=>'form-control']) !!}
                {!! $errors->first('selenium', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="form-group{{ $errors->has('zinc') ? ' has-error' : '' }}">
        <div class="row" style="padding-top:3px;padding-bottom:3px;">
            {!! Form::label('zinc', 'Zinc (Zn)', ['class'=>'col-md-6 control-label']) !!} 
            <div class="col-md-4">
                {!! Form::text('zinc', null, ['class'=>'form-control']) !!}
                {!! $errors->first('zinc', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
  </div>
</div>