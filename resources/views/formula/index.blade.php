@extends('layouts.app')

@section('title')
  Formula - {{ config('configuration.site_name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-plus-circle"></i> Pilih Jenis Ransum </h4>
                </div>
                    <div class="panel-body">
                    {!! Form::open(['url' => 'formula/input','class'=>'form-horizontal','id'=>'input']) !!}
                        <div class="form-group">
                            {{ Form::label('var', 'Jenis Ransum', ['class' => 'col-sm-5 control-label']) }}
                            <div class="col-md-7">
                                {!! Form::select('requirement_id', [''=>'']+App\Requirement::pluck('animal_type','id')->all(), null,['class'=>'js-selectize','placeholder' => 'Pilih Jenis Ransum']) !!}
                                {!! $errors->first('requirement_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <input type="submit" class="pull-right btn btn-lg btn-success" value="Formulasi">
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
                {!! Form::open(['url' => 'input','class'=>'form-horizontal']) !!}
                <div class="panel-body">
                    <div id="nutrient_result"></div>
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
                requirement_id: {
                    required: true
                }
            },
            messages: {
                requirement_id: {
                    required : "Jenis ransum harus diisi"
                }
            }
        });    
    });

    $('#lihat_requirement').click(function(){
        var req_id =  1;

        $.ajax({
            type: "GET",
            url : "{{ route('ajax.find') }}",
            data : { req_id: req_id },
            dataType : "json",
            success : function(data){
                $("#nutrient_result").empty();
                $('#loading').hide();
                
                if(JSON.stringify(data) === JSON.stringify({}) || JSON.stringify(data) === JSON.stringify([])) 
                {
                    $("#alert").show();
                } 
                else 
                {
                    alert(data);
                    $("#result").show();
                    $("#next").removeAttr('disabled');
                    $("#nutrient_result").html(data);
                }
            }
        }, "json")
    });
</script>
@endsection