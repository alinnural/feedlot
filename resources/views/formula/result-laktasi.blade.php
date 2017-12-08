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
                    <h4><i class="fa fa-breafcase"></i> Analisis Kecukupan Nutrien</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Berat Badan', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-8">
                                <p>{{ $data["bb"] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Produksi Susu', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-8">
                                <p>{{ $data["ps"] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {{ Form::label('var', 'Bulan Laktasi', ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-md-8">
                                <p>{{ $data["bl"] }}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class='row' id='results'>
                        <div class='col-md-12'>
                            <div class='panel panel-default'>
                                <table class='table table-stripped'>
                                    <tr>
                                        <th>Nutrien</th>
                                        <th>Pemberian</th>
                                        <th>Kebutuhan</th>
                                        <th width='250'>Kelebihan/Kekurangan</th>
                                        <th width='150'>Keterangan</th>
                                    </tr>
                                    @foreach ($hasil as $key => $value)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td><span>{{ round($pemberian[$key],2) }}</span></td>
                                        <td>{{ round($kebutuhan[$key]["satuan"],2) }}</td>
                                        <td><span>{{ round($value,2) }}</span></td>
                                        <th>
                                            @if($value > 0.05*$pemberian[$key])
                                                <p>Lebih</p>
                                            @elseif($value < 0.05*$pemberian[$key])
                                                <p>Kurang</p>
                                            @else
                                                <p>Cukup</p>
                                            @endif
                                        </th>
                                    </tr>
                                    @endforeach
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
@endsection

@section('scripts')
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    });
</script>
@endsection