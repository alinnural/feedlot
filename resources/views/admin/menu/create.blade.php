@extends('layouts.app')

@section('title')
  Tambah Menu - Admin {{ config('configuration.site_name') }}
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/admin') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/menu') }}">Menu</a></li>
          <li class="active">Tambah Menu</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Tambah Menu</h2>
        </div>
        <div class="panel-body">
        {!! Form::open(['url' => route('menu.store'),'method' => 'post', 'files'=>'true', 'class'=>'form-horizontal']) !!}
        @include('admin.menu._form')
        {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote();
    $('#row_halaman').hide();
    $('#row_link').hide();
    $('#row_parent').hide();
});

$('#type').change(function(){
    if($('#type').val() == '1') {
        $('#row_halaman').hide();
        $('#row_link').show();
    }
    if($('#type').val() == '2') {
        $('#row_halaman').show();
        $('#row_link').hide();
    }
});


$('input[name=is_parent]').change(function () {
    if($(this).val() == '0')
    {
        $("#row_parent").show();
    }
    else
    {
        $("#row_parent").hide();
    }

});

</script>
@endsection