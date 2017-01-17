@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pilih Requirement (Kebutuhan Sapi Dengan Bobot tertentu)</div>
                    {!! Form::open(['url' => 'input','class'=>'form-horizontal']) !!}
                    <div class="panel-body">    
                        <div class="form-group">
                            {{-- Form::label('var', 'Pilih Requirement', ['class' => 'col-sm-4 control-label']) --}}
                            <div class="col-md-12">
                                <select id="requirement_list" name="requirement" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <a href="/input" class="pull-right btn btn-primary">Langkah Selanjutnya</a>
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
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#result").hide();
    });

    $('#requirement_list').select2({
        placeholder: "Choose Requirement...",
        minimumInputLength: 2,
        ajax: {
            url: '/ajax/requirements/search',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data,
                };
            },
            cache: true
        }
    })
    .on("change", function(e) {
        //console.log($(this).select2('data'));
        var data = $(this).select2('data');
        //Then I take the values like if I work with an array
        var value = data[0].id;
        //alert(value);
        $('#loading').show();
        $("#result").hide();

        $.ajax({
            type: "GET",
            url : "/ajax/requirements/find",
            data : { id: value },
            dataType : "json",
            success : function(data){
                $("#result").show();
                $('#loading').hide();

                clear_data();

                if(JSON.stringify(data)=='{}') 
                {
                    //console.log(data);
                    document.getElementById("#result").innerHTML="<p> Your article was successfully added!</p>";
                } 
                else 
                {
                    show_data(data);
                }
            }
        }, "json")
        .fail(function(data){
            // on an error show us a warning and write errors to console
            var errors = data.responseJSON;
            alert('an error occured, check the console (f12)');
            console.log(errors);
        });;
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

