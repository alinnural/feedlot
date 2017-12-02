@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">      
        @include('layouts.menu')  
        {!! Form::open(['url' => 'formula/calc_laktasi','class'=>'form-horizontal','method'=>'POST','target'=>'_blank']) !!}
        <input type="hidden" class="x">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Data Sapi Perah Laktasi</h4>
                </div>
                <div class="panel-body">  
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Berat Badan (kg)', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::number('bb', '',['class' => 'form-control', 'id'=>'bb'])}}
                                {!! $errors->first('bb', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Produksi Susu (kg/hari)', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::number('ps', '',['class' => 'form-control', 'id'=>'ps'])}}
                                {!! $errors->first('ps', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Bulan Laktasi (bulan)', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::number('bl', '',['class' => 'form-control', 'id'=>'bl'])}}
                                {!! $errors->first('bl', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-offset-3 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Pilih pakan ternak yang akan diformulasikan</h4>
                </div>
                <div class="panel-body">    
                    <div class='form-group feeds-container'>
                        <div id="0">
                            <div class='col-md-4'>
                                {!! Form::select('feeds[]',$feeds,null,['class'=>'form-control feed_list','placeholder' => '- Pilih Pakan -','onchange'=>'getFeed(this)']) !!}
                            </div>
                            <div class='col-md-4'>
                                {{ Form::number('kuantitas[]', '',['class' => 'form-control kuantitas','placeholder' => 'Kuantitas'])}} 
                            </div>
                            <div class='col-md-1'>
                                <a href='#' class='btn btn-sm btn-danger btn-remove'>Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="result-btn-add"></div>
                    <a href="#" class="btn btn-success" id="btn-add-more"><i class="fa fa-plus-square-o"></i> Tambah Pakan</a>
                </div>
                <div class="panel-footer">
                        <div class="row">
                        <div class="col-md-4">
                            <a href="{{url('formula')}}" class="pull-left btn btn-lg btn-primary" id="next"><i class="fa fa-lg fa-arrow-circle-o-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-8">
                            {{ Form::button('<span class="fa fa-lg fa-arrow-circle-o-right"></span> Lanjut', array('class'=>'btn btn-success btn-lg pull-right', 'type'=>'submit')) }}
                        </div>
                    <div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="loader"></div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".x").val(0);
        $(".loader").fadeOut("slow");
        $('.feed_list').select2({
            minimumInputLength: 0,
            width:250,
            dropdownAutoWidth : true
        });
    });
    
    $('#btn-add-more').on('click',function(e){
        var x = parseInt($('.x').val());
        $('.x').val(++x);
        var feed_list = '<div class="col-md-4">'+
                            '{!! Form::select("feeds[]",$feeds,null,["class"=>"form-control feed_list","placeholder" => "- Pilih Pakan -","onchange"=>"getFeed(this)"]) !!}'+
                        '</div>';
        var template_feed = "<div class='form-group feeds-container'>"+
                                "<div id='"+x+"'>"+
                                    feed_list+
                                    "<div class='col-md-4'>"+
                                        "<input class='form-control kuantitas' placeholder='Kuantitas' name='kuantitas[]' type='number' value=''> "+
                                    "</div>"+
                                    "<div class='col-md-1'>"+
                                        "<a href='#' class='btn btn-sm btn-danger btn-remove'>Hapus</a>"+
                                    "</div>"+
                                "</div>"+
                            "</div>";

        e.preventDefault();
        $(".result-btn-add").before(template_feed);
        $('.feed_list').select2({
            minimumInputLength: 0,
            width:250,
            dropdownAutoWidth : true
        });
    });

    $(document).on('click','.btn-remove',function(e){
        e.preventDefault();
        $(this).parents('.feeds-container').remove();
    });

    function getFeed(feed){
        var feed_id = feed.value;
        var num_feed = feed.parentNode.parentNode.id;
        $.ajax({
            type: "GET",
            url : "{{ route('ajax.feed_find') }}",
            data : { feed_id: feed_id },
            dataType : "json",
            success : function(data){
                $(".min_feed_"+num_feed).val(data.min);
                $(".max_feed_"+num_feed).val(data.max);
            }
        }, "json")
    };
</script>
@endsection

