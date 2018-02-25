@extends('layouts.app')

@section('title')
  Formula - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">      
        @include('layouts.menu')  
        {!! Form::open(['url' => 'formula/calculate','class'=>'form-horizontal','method'=>'POST','target'=>'_blank']) !!}
        <input type="hidden" class="x">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Kandungan nutrisi ransum</h4>
                </div>
                <div class="panel-body">    
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="200px;">Nutrisi</th>
                                <th width="200px;">Minimum (%)</th>
                                <th width="200px;">Maksimum (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reqnuts as $item)
                            <tr>
                                <td>{{ $item['name'] }}<input type="hidden" name="reqnuts[]" value="{{ $item['id'] }}"><input type="hidden" name="reqnuts_name[]" value="{{ $item['name'] }}"></td>
                                <td>{!! Form::text('min_composition[]', $item['min_composition'], ['class'=>'form-control','placeholder'=>'Kandungan minimum']) !!}</td>
                                <td>{!! Form::text('max_composition[]', $item['max_composition'], ['class'=>'form-control','placeholder'=>'Kandungan maksimum']) !!}</td>
                            <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Pilih pakan yang digunakan</h4>
                </div>
                <div class="panel-body">
                    <div class='form-group'>
                        <div>
                            <div class='col-md-4'>
                                <strong>Pakan</strong>
                            </div>
                            <div class='col-md-2'>
                                <strong>Minumum (%)</strong> 
                            </div>
                            <div class='col-md-2'>
                                <strong>Maksimum (%)</strong> 
                            </div>
                            <div class='col-md-2'>
                                <strong>Harga (Rp)</strong> 
                            </div>
                            <div class='col-md-1'>                                
                            </div>
                        </div>
                    </div>
                    <div class='form-group feeds-container'>
                        <div id="0">
                            <div class='col-md-4'>
                                {!! Form::select('feeds[]',$feeds,null,['class'=>'form-control feed_list','placeholder' => '- Pilih Pakan -','onchange'=>'getFeed(this)']) !!}
                            </div>
                            <div class='col-md-2'>
                                {{ Form::text('min_feed[]', '',['class' => 'form-control min_feed_0','placeholder' => 'Nilai min'])}} 
                            </div>
                            <div class='col-md-2'>
                                {{ Form::text('max_feed[]', '',['class' => 'form-control max_feed_0','placeholder' => 'Nilai maks'])}} 
                            </div>
                            <div class='col-md-2'>
                                {{ Form::number('harga[]', '',['class' => 'form-control harga_0','placeholder' => 'Harga'])}} 
                            </div>
                            <div class='col-md-1'>
                                <a href='#' class='btn btn-sm btn-danger btn-remove'>Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="result-btn-add"></div>
                    <a href="#" class="btn btn-sm btn-success" id="btn-add-more"><i class="fa fa-plus-square-o"></i> Tambah Pakan</a>
                </div>
                <div class="panel-footer">
                        <div class="row">
                        <div class="col-md-4">
                            <a href="{{url('formula')}}" class="pull-left btn btn-primary" id="next"><i class="fa fa-arrow-circle-o-left"></i> Kembali</a>
                        </div>
                        <div class="col-md-8">
                            {{ Form::button('<span class="fa fa-arrow-circle-o-right"></span> Formulasi', array('class'=>'btn btn-info pull-right', 'type'=>'submit')) }}
                        </div>
                    <div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".x").val(0);
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
                                    "<div class='col-md-2'>"+
                                        "<input class='form-control min_feed_"+x+"' placeholder='Nilai min' name='min_feed[]' type='text' value=''> "+
                                    "</div>"+
                                    "<div class='col-md-2'>"+
                                        "<input class='form-control max_feed_"+x+"' placeholder='Nilai maks' name='max_feed[]' type='text' value=''> "+
                                    "</div>"+
                                    "<div class='col-md-2'>"+
                                        "<input class='form-control harga_"+x+"' placeholder='Harga' name='harga[]' type='number' value=''> "+
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
                $(".harga_"+num_feed).val(data.price);
            }
        }, "json")
    };
</script>
@endsection

