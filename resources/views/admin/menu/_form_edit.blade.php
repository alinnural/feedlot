<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
  {!! Form::label('name', 'Nama', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
    {!! Form::label('type','Jenis Menu',['class'=>'col-md-3 control-label'])!!}
    <div class="col-sm-9">
        <select name="type" class="form-control" id="type">
            <option readonly>
                - Pilih Jenis Menu -
            </option>
            <option value="1" @if($menu->type == 1) selected @endif>
                Link
            </option>
            <option value="2" @if($menu->type == 2) selected @endif>
                Halaman
            </option>
        </select>
    </div>
</div>
<div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}" id="row_link"> 
  {!! Form::label('url', 'URL / Link', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('url', null, ['class'=>'form-control']) !!}
    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('page_id') ? ' has-error' : '' }}" id="row_halaman"> 
  {!! Form::label('page_id', 'Halaman', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::select('page_id', [''=>'']+App\Page::pluck('title','id')->all(), null, ['class'=>'js-selectize','placeholder' => 'Pilih Halaman']) !!}
    {!! $errors->first('page_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}"> 
  {!! Form::label('position', 'Posisi', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::text('position', null, ['class'=>'form-control']) !!}
    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group{{ $errors->has('is_parent') ? ' has-error' : '' }}">
    {!! Form::label('is_parent','Parent',['class'=>'col-md-3 control-label']) !!}
    <div class="col-sm-9">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_parent','1',true) !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('is_parent','0') !!}
        Tidak
      {!! $errors->first('is_parent', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}" id="row_parent"> 
  {!! Form::label('parent_id', 'Menu Parent', ['class'=>'col-md-3 control-label']) !!} 
  <div class="col-md-9">
    {!! Form::select('parent_id', [''=>'']+App\Menu::pluck('name','id')->all(), null, ['class'=>'js-selectize','placeholder' => 'Pilih Menu Parent']) !!}
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="form-group">
    {!! Form::label('have_child','Punya Anak',['class'=>'col-md-3 control-label'])!!}
    <div class="col-sm-9">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('have_child','1',true) !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('have_child','0') !!}
        Tidak
      {!! $errors->first('have_child', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('active','Aktif',['class'=>'col-md-3 control-label'])!!}
    <div class="col-sm-9">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('active','1') !!}
        Ya  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! Form::radio('active','0') !!}
        Tidak
      {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
  <div class="col-md-4 col-md-offset-3">
    {{ Form::button('<span class="fa fa-save"></span> Simpan', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
    <a href="{{ url('admin/menu') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
</div>
@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote();

    var type = "@php echo $menu->type; @endphp";
    show(type);

    var id = "@php echo $menu->is_parent; @endphp";
    show_parent(id);    
});

$('#type').change(function(){
    var type = $('type').val();
    show(type);
});

function show(type){
  if(type == '1') {
      $('#row_halaman').hide();
      $('#row_link').show();
  }
  if(type == '2') {
      $('#row_halaman').show();
      $('#row_link').hide();
  }
}

function show_parent(id){
  if(id == '0')
  {
      $("#row_parent").show();
  }
  else
  {
      $("#row_parent").hide();
  }
}
$('input[name=is_parent]').change(function () {
  var id = $(this).val();
  show_parent(id);
});

</script>
@endsection