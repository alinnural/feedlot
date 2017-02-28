@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-circle"></i> Pilih Requirement (Kebutuhan Sapi Dengan Bobot tertentu) </h4>
                </div>
                    <div class="panel-body">
                    {!! Form::open(['url' => 'formula/input','class'=>'form-horizontal','id'=>'input']) !!}
                        <div class="form-group">
                            {{ Form::label('var', 'Berat Badan (Kg)', ['class' => 'col-sm-5 control-label']) }}
                            <div class="col-md-7">
                                {{--<select id="requirement_list" name="requirement" class="form-control"></select>--}}
                                {{ Form::number('current', '',['class' => 'form-control'])}} 
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('var', 'Average Daily Gain (ADG)', ['class' => 'col-sm-5 control-label','id'=>'average_daily_gain']) }}
                            <div class="col-md-7">
                                {{--<select id="requirement_list" name="requirement" class="form-control"></select>--}}
                                {{ Form::number('average_daily_gain', '',['class' => 'form-control'])}} 
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <a href="formula/input" class="pull-right btn btn-lg btn-default" id="next"><i class="fa fa-lg fa-arrow-circle-o-right"></i> Lanjut</a>
                                <a href="#" type="submit" class="pull-left btn btn-lg btn-success" id="lihat_requirement"><i class="fa fa-lg fa-eye"></i> Lihat Kebutuhan</a>
                            </div>
                        <div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="panel text-center text-gray" id="loading" style="display: none;">
        <h3><i class="fa fa-spinner fa-spin"></i> Loading Data</h3>
    </div>
    <div class="row" id="alert" style="display:none;">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert"><h4><i><center>Data kebutuhan sapi potong tidak ditemukan.</center></i></h4></div>
        </div>
    </div>
    <div class="row" id="result" style="display:none;">
        <div class="col-md-12">
            <div class="panel panel-default"> 
                <div class="panel-body">
                {!! Form::open(['url' => 'input','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('var', 'Animal Type', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-md-8">
                            <div id="animal_type"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('var', 'Current Weight', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-md-8">
                            <div id="current_weight"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('var', 'Finish Weight', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-md-8">
                            <div id="finish_weight"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('var', 'Average Daily Gain (ADG)', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="adg"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Dry Matter Intake (DMI)', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="dmi"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Total Digestible Nutrient (TDN)', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="tdn"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Net Energy For Maintenance', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="nem"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Net Energy for Gain', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="neg"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Crude Protein', ['class' => 'col-sm-8 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="cp"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('var', 'Total Dietary of Calcium', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="ca"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Total Dietary of Phosphorus', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="p"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Month Pregnant', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="month_pregnant"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Months Since Calving', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="month_calvin"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Peak Milk', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="peak_milk"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('var', 'Current Milk', ['class' => 'col-sm-7 control-label']) !!}
                                <div class="col-md-4">
                                    <div id="current_milk"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="loader"></div>
@endsection

@section('scripts')
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".loader").fadeOut("slow");
        $("#result").hide();
        $("#next").attr("disabled","disabled");
        $('#input').validate({ // initialize the plugin
            rules: {
                current: {
                    required: true,
                    number:true,
                },
                average_daily_gain: {
                    required: true,
                    number:true,
                    range: [0, 1]
                }
            },
            messages: {
                current: {
                    required : "Berat badan (kg) harus diisi",
                    number: "Berat badan (kg) harus angka",
                },
                average_daily_gain: {
                    required: "Average Daily Gain (ADG) harus diisi",
                    number: "Average Daily Gain (ADG) harus angka",
                    range: "Average Daily Gain (ADG) tidak boleh lebih dari 1",
                },
            }
        });    
    });

    $('#lihat_requirement').click(function(){
        var current_weight =  $('input[name=current]').val();
        var average_daily_gain = $('input[name=average_daily_gain]').val();
        
        if(!$("#input").valid())
        {
            return false;
        }

        $('#loading').show();
        $("#result").hide();
        $('#alert').hide();
        $("#next").attr("disabled","disabled");

        $.ajax({
            type: "GET",
            url : "/ajax/requirements/find",
            data : { current_weight: current_weight, average_daily_gain: average_daily_gain },
            dataType : "json",
            success : function(data){
                clear_data();
                $('#loading').hide();
                if(JSON.stringify(data) === JSON.stringify({}) || JSON.stringify(data) === JSON.stringify([])) 
                {
                    $("#alert").show();
                } 
                else 
                {
                    $("#result").show();
                    $("#next").removeAttr('disabled');
                    show_data(data);
                }
            }
        }, "json")
    });

    function clear_data()
    {
        $("#animal_type").empty();
        $("#current_weight").empty();
        $("#finish_weight").empty();
        $("#adg").empty();
        $("#dmi").empty();
        $("#tdn").empty();
        $("#nem").empty();
        $("#neg").empty();
        $("#cp").empty();
        $("#ca").empty();
        $("#p").empty();
        $("#month_pregnant").empty();
        $("#month_calvin").empty();
        $("#peak_milk").empty();
        $("#current_milk").empty();
    }

    function show_data(data)
    {
        $("<p>"+data.animal_type+"</p>").appendTo("#animal_type");
        $("<p>"+data.current+"</p>").appendTo("#current_weight");
        $("<p>"+data.finish+"</p>").appendTo("#finish_weight");
        $("<p>"+data.adg+"</p>").appendTo("#adg");
        $("<p>"+data.dmi+"</p>").appendTo("#dmi");
        $("<p>"+data.tdn+"</p>").appendTo("#tdn");
        $("<p>"+data.nem+"</p>").appendTo("#nem");
        $("<p>"+data.neg+"</p>").appendTo("#neg");
        $("<p>"+data.cp+"</p>").appendTo("#cp");
        $("<p>"+data.ca+"</p>").appendTo("#ca");
        $("<p>"+data.p+"</p>").appendTo("#p");
        $("<p>"+data.month_pregnant+"</p>").appendTo("#month_pregnant");
        $("<p>"+data.month_calvin+"</p>").appendTo("#month_calvin");
        $("<p>"+data.peak_milk+"</p>").appendTo("#peak_milk");
        $("<p>"+data.current_milk+"</p>").appendTo("#current_milk");
    }
</script>
@endsection