@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-circle"></i> Pilih pakan ternak yang akan diformulasikan</h4>
                </div>
                    {!! Form::open(['url' => 'formula/price','class'=>'form-horizontal','method'=>'GET']) !!}
                    <div class="panel-body">    
                            <div class="form-group feeds-container">
                                {{--} Form::label('var', 'Pilih Pakan', ['class' => 'col-sm-4 control-label']) --}}
                            <div>
                            <div class="col-md-10">
                                {!! Form::select('feeds[]',$feeds,null,['class'=>'input-sm feed_list','placeholder' => '- Pilih Pakan -']) !!}
                            </div>
                            <div class="col-md-2">
                                <a href="#" class="btn btn-sm btn-danger btn-remove">Hapus</a>
                            </div>
                            </div>
                        </div>
                        <div class="result-btn-add"></div>
                        <a href="#" class="btn btn-success" id="btn-add-more"><i class="fa fa-plus-square-o"></i> Tambah Pakan</a>
                    </div>
                    <div class="panel-footer">
                         <div class="row">
                            <div class="col-md-4">
                                <a href="/" class="pull-left btn btn-lg btn-default" id="next"><i class="fa fa-lg fa-arrow-circle-o-left"></i> Kembali</a>
                            </div>
                            <div class="col-md-8">
                                {{ Form::button('<span class="fa fa-lg fa-arrow-circle-o-right"></span> Lanjut', array('class'=>'btn btn-default btn-lg pull-right', 'type'=>'submit')) }}
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="loader"></div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow");
        $('.feed_list').select2({
            minimumInputLength: 2,
            width:600,
            dropdownAutoWidth : true
        });
    });
    
    var template_feed = '<div class="form-group feeds-container">'+
                            //'{!! Form::label('var', 'Pilih Pakan', ['class' => 'col-sm-4 control-label']) !!} '+
                            '<div>'+
                            '<div class="col-md-10">'+
                                '{!! Form::select('feeds[]',$feeds,null,['class'=>'input-sm feed_list','placeholder' => '- Pilih Pakan -']) !!}'+
                           '</div>'+
                            '<div class="col-md-2">'+
                                '<a href="" class="btn btn-sm btn-danger btn-remove">Hapus</a>'+
                            '</div>'+
                            '</div>'+
                        '</div>';

    $('#btn-add-more').on('click',function(e){
        e.preventDefault();
        $(".result-btn-add").before(template_feed);
        $('.feed_list').select2({
            minimumInputLength: 2,
            width:600,
            dropdownAutoWidth : true
        });
    });

    $(document).on('click','.btn-remove',function(e){
        e.preventDefault();
        $(this).parents('.feeds-container').remove();
    });
</script>
@endsection

