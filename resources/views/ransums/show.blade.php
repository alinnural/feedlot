@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a href="{{ url('formula/print/'.$forsum->id) }}" class="btn btn-primary"></i> Print</a>
                </div>
                <h4><i class="fa fa-breafcase"></i> Ransum</h4>
            </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Kuantitas Ransum (kg)', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-3">
                                {{ Form::number('kuantitas', '1000',['class' => 'form-control', 'id'=>'kuantitas'])}}
                                {!! $errors->first('kuantitas', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-md-3">
                                <input type="button" class="btn btn-success" value="Submit" onclick="calc()">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Nama Ransum', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-8">
                                <p>{{ $forsum->name }}</p>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Keterangan', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-8">
                                <p>{{ $forsum->explanation }}</p>
                                {!! $errors->first('explanation', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class='row' id='results'>
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <table class='table table-stripped'>
                                    <tr>
                                        <th>Pakan</th>
                                        <th class='text-center'>Persentase</th>
                                        <th width='10'>&nbsp;</th>
                                        <th class='text-center' width='250'>Harga</th>
                                        <th class='text-right' width='150'>Kuantitas</th>
                                        <th width='50'>&nbsp;</th>
                                        <th class='text-right' width='250'>Total Harga</th>
                                    </tr>
                                    @php $kuantitas=0; $total_price_kuant = 0; @endphp   
                                    @foreach ($forfeeds as $item)
                                    <tr>
                                        <td>{{ $item->feed->name }}</td>
                                        <td><span class='align-center'>{{ $item->result }} %</span></td>
                                        <th>&nbsp;</th>
                                        <td><span class='pull-left'>IDR</span> <span class='pull-right'>{{ $item->price }} / kg</span></td>
                                        <td><span class='pull-right'>@php $kuant = $item->result*1000/100; $kuantitas+=$kuant; @endphp {{ $kuant }} kg</span></td>
                                        <th>&nbsp;</th>
                                        <td><span class='pull-left'>IDR</span><span class='pull-right'>@php $price_kuant = $item->price*$kuant; $total_price_kuant+=$price_kuant; @endphp {{ number_format($price_kuant, 2, ',', '.') }}</span></td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td width='300'><strong><h4>{!! Form::label('var', 'Harga Terakhir', ['class' => 'control-label']) !!}</strong></h4></td>
                                        <td>&nbsp;</td>
                                        <th>&nbsp;</th>
                                        <td><strong><h4><span class='pull-left'>IDR</span> <span class='pull-right'>{{ round($forsum->total_price) }} /kg</span></h4></strong></td>
                                        <td><span class='pull-right'><h4>{{ $kuantitas }} kg</h4></span></td>
                                        <th>&nbsp;</th>
                                        <td><strong><h4><span class='pull-left'>IDR</span><span class='pull-right'>{{ number_format($total_price_kuant, 2, ',', '.') }}</h4></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>                        
                    </div>      
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Nutrisi</th>
                                            <th>Minimum</th>
                                            <th>Maksimum</th>
                                            <th>Hasil Formulasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fornuts as $item)
                                        <tr>
                                            <td><label class="control-label">{{ $item->nutrient->name }}</label></td>
                                            <td>{{ $item->min }}</td>
                                            <td>{{ $item->max }}</td>
                                            <td>{{ $item->result }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>             
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
    });

    function calc(){
        var quantity = parseInt($('#kuantitas').val());
        var harga_terakhir = @php echo $forsum->total_price ; @endphp ;

        $.ajax({
            type: "GET",
            url : "{{ route('ajax.calcquantity') }}",
            data : { qty: quantity, harga_terakhir:harga_terakhir },
            dataType : "json",
            success : function(data){
                $("#results").empty();
                $('#loading').hide();
                
                if(JSON.stringify(data) === JSON.stringify({}) || JSON.stringify(data) === JSON.stringify([])) 
                {
                    $("#alert").show();
                } 
                else 
                {                 

                    document.getElementById("results").innerHTML = data;
                }
            }
        }, "json")        
    }
</script>
@endsection