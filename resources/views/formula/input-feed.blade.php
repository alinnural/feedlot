@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pilih takan ternak yang akan diformulasikan</div>
                    {!! Form::open(['url' => 'price','class'=>'form-horizontal','method'=>'GET']) !!}
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
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <a href="#" class="btn btn-default" id="btn-add-more">Tambah Pakan</a>
                                {!! Form::submit('Lanjut',['class'=>'btn btn-primary']) !!}
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
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

