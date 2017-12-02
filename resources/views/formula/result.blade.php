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
                    <div class="btn-group pull-right">
                        <a href="{{url('/')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <h4><i class="fa fa-breafcase"></i> Hasil Optimasi </h4>
                </div>
                <div class="panel-body">
                    <a class="btn btn-success" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-list-alt"></i> Lihat Hasil Perhitungan Matriks
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="well">
                            <h4>Inisialisasi Tableau</h4>
                                <table class="table table-bordered">
                                    @for($i=0; $i <= $minimization->get_num()[0]; $i++)
                                        <tr>
                                        @for($j=0; $j<=$minimization->get_total_number()+1; $j++)
                                            <td>{{ $initial_tableau[$i][$j] }}</td>
                                        @endfor
                                        </tr>
                                    @endfor
                                </table>

                                <h4>Solusi Dasar</h4>
                                <table class="table table-bordered">
                                    <tr>
                                    <!--in the minimization problem, since we are using the dual, the value of the unknown variables would be the values of the slack variables-->
                                    @for($i=0; $i<=$minimization->get_total_number(); $i++)
                                        @if(($i+1)<=$minimization->get_num()[1])
                                            @php $sub=$i+1; @endphp
                                            <td id='each'> y{{ $sub }} = {{ $initial_tableau[$minimization->get_num()[0]][$i] }}</td>
                                        @else
                                            @php $sub=$i-$minimization->get_num()[1]+1; @endphp
                                            @if($sub<=$minimization->get_num()[0])
                                                <td id='each'> x{{ $sub }} = {{ $initial_tableau[$minimization->get_num()[0]][$i] }}</td>
                                            @else
                                                <td id='each'> z = {{ $initial_tableau[$minimization->get_num()[0]][$minimization->get_total_number()+1] }}</td>
                                            @endif
                                        @endif
                                    @endfor
                                    </tr>
                                </table>
                            @php 
                            $flag = 0; 
                            $harga_terakhir = 0;
                            $nutrients = array();
                            $feeds = array();
                            @endphp

                            <!--the maximum number of iterations would be 100, if it excedes the maximum, the problem is infeasible -->
                            @for($max=0; $max<100; $max++)
                                
                                <!--get the index of the column with the smallest value-->
                                @php
                                $num = $minimization->get_num();
                                $total_number = $minimization->get_total_number();
                                $minCol = $minimization->getMinimumColumn($initial_tableau, $num[0], $total_number); 
                                @endphp
                                <!--if there are no negative values, the problem is already minimized-->
                                @if($minCol==$total_number+2)			
                                    @break
                                @endif

                                <!--get the index of the row with the smallest ratio a/b -> a is the rightmost column and b is the positive entry from the minCol-->
                                @php $minRow = $minimization->getMinimumRow($initial_tableau, $num[0], $minCol, $total_number); @endphp
                                <!--if there are no non-negative or zero, the problem is infeasible-->
                                
                                @if($minRow==$num[0])
                                    @php $flag=1; @endphp
                                    <p class='final'>Tidak mungkin (Problem is infeasible). </p>
                                    @break
                                @endif
                                
                                <!--display the iteration number-->
                                @php $itr=$max+1; @endphp
                                <h4>Iterasi ke: {{ $itr }}</h4>
                                
                                <!--normalize the pivot row-->
                                <!--divide the pivot row by the pivot element-->
                                @for($i=0; $i<=$total_number+1; $i++)
                                    @if($i!=$minCol)
                                        @php $initial_tableau[$minRow][$i]=$initial_tableau[$minRow][$i]/$initial_tableau[$minRow][$minCol]; @endphp
                                    @endif
                                @endfor
                                @php $initial_tableau[$minRow][$minCol]=1; @endphp
                                
                                <!--make the rest of the elements of the pivot column 0-->
                                @for($i=0; $i<=$num[0]; $i++)
                                    @if($i!=$minRow)
                                        @for($j=0; $j<=$total_number+1; $j++)
                                            @if($j!=$minCol)
                                                @php $initial_tableau[$i][$j]=$initial_tableau[$i][$j]-($initial_tableau[$i][$minCol] * $initial_tableau[$minRow][$j]); @endphp
                                            @endif
                                        @endfor
                                        @php $initial_tableau[$i][$minCol]=0; @endphp
                                    @endif
                                @endfor
                                
                                <!--display the table per iteration-->
                                <table class="table table-bordered">
                                @for($i=0; $i<=$num[0]; $i++)
                                    <tr>
                                    @for($j=0; $j<=$total_number+1; $j++)
                                        <td id='each'>{{ round($initial_tableau[$i][$j],5) }}</td>
                                    @endfor
                                    </tr>
                                @endfor
                                </table>
                                
                                <!--display the basic solution per iteration-->
                                <h4>Basic Solution</h4>
                                    <table class="table table-bordered">
                                    <tr>
                                    @for($i=0; $i<=$total_number; $i++)
                                        @if(($i+1)<=$num[1])
                                            @php 
                                            $sub=$i+1;
                                            $nutrients[$sub] = round($initial_tableau[$num[0]][$i],5);
                                            @endphp
                                            <td id='each'> y{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],5) }}</td>
                                            
                                        @else
                                            @php $sub=$i-$num[1]+1; @endphp
                                            @if($sub<=$num[0])
                                                <td id='each'> x{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],5) }}</td>
                                                @php $feeds[$sub] = round($initial_tableau[$num[0]][$i],5); @endphp
                                            @else
                                                <td id='each'> z = {{ round($initial_tableau[$num[0]][$total_number+1],5) }}</td>
                                            @endif
                                        @endif
                                        @php 
                                        $harga_terakhir = round($initial_tableau[$num[0]][$total_number+1],5);
                                        @endphp
                                    @endfor
                                    </tr>
                                </table>
                            @endfor
                            <!-- if the number of iterations reaches 100, the problem is infeasible -->
                            @if($max==100)
                                @php $flag=1; @endphp
                                <p class='final'>Tidak Mungkin (Problem is infeasible). </p>
                            @endif

                            @if($minRow!=$total_number && $flag!=1)
                                <!-- display the final table -->
                                <p class='final'>Final Tableau: </p>
                                <table class="table table-bordered">
                                    @for($i=0;$i<=$num[0];$i++)
                                    <tr>
                                        @for($j=0;$j<=$total_number+1;$j++)
                                            <td>{{ round($initial_tableau[$i][$j],5) }}</td>
                                        @endfor
                                    </tr>
                                    @endfor
                                </table>
                                <br>
                                
                                <!-- display the final basic solution -->
                                <p class='final'>Final Basic Solution:</p>
                                <table class="table table-bordered">
                                    <tr>
                                    @for($i=0;$i<=$total_number;$i++)
                                        @if(($i+1) <= $num[1])
                                            @php 
                                            $sub = $i+1; 
                                            $nutrients[$sub] = round($initial_tableau[$num[0]][$i],5);
                                            @endphp
                                            <td>y{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],5) }}</td>
                                        @else
                                            @php $sub = $i- $num[1]+1; @endphp
                                            @if($sub <= $num[0])
                                                <td>x{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],5) }}</td>
                                                @php $feeds[$sub] = round($initial_tableau[$num[0]][$i],5); @endphp
                                            @else
                                                <td>z = {{ round($initial_tableau[$num[0]][$total_number+1],5) }}</td>
                                            @endif
                                        @endif
                                        @php $harga_terakhir = round($initial_tableau[$num[0]][$total_number+1],5); @endphp
                                    @endfor
                                    </tr>
                                </table>
                            @endif
                        </div>              
                    </div>
                    <br>&nbsp;<br>
                    @if($flag==1)
                        <p class='final'>Tidak mungkin (Problem is infeasible).</p>
                    @else
                        <div class="row" id="result">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <table class="table table-stripped">
                                        <tr>
                                            <th>Pakan</th>
                                            <th class="text-right">Persentase</th>
                                            <th width="100">&nbsp;</th>
                                            <th class="text-center" width="200">Harga</th>
                                            <th class="text-right" width="200">Kuantitas</th>
                                        </tr>
                                        @php $kuantitas=0; @endphp
                                        @foreach (Calculate::mapping_feed_id_result(Session::get('feeds'),Session::get('harga'),$feeds,$harga_terakhir) as $feed)
                                        <tr>
                                            <td>{{ $feed['name'] }}</td>
                                            <td><span class="pull-right">{{ $feed['result'] }} %</span></td>
                                            <th>&nbsp;</th>
                                            <td><span class="pull-left">IDR</span> <span class="pull-right">{{ $feed['price'] }} / kg</span></td>
                                            <td><span class="pull-right">@php $kuant = $feed['result']*Session::get('kuantitas')/100; $kuantitas+=$kuant; @endphp {{ $kuant }} kg</span></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td width="300"><strong><h4>{!! Form::label('var', 'Harga Terakhir', ['class' => 'control-label']) !!}</strong></h4></td>
                                            <td>&nbsp;</td>
                                            <th>&nbsp;</th>
                                            <td><strong><h4><span class="pull-left">IDR</span> <span class="pull-right">{{ round($harga_terakhir) }},00</span></h4></strong></td>
                                            <td><span class="pull-right"><h4>{{ $kuantitas }} kg</h4></span></td>
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
                                            @foreach (Calculate::mapping_nutrient_id_result(Session::get('feeds'),$requirement,$feeds) as $nu)
                                            <tr>
                                                <td><label class="control-label">{{ $nu['name'] }}</label></td>
                                                <td>{{ $nu['min_composition'] }}</td>
                                                <td>{{ $nu['max_composition'] }}</td>
                                                <td>{{ $nu['result'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                        <div class="row">
                        <div class="col-md-12 pull-right">
                            {{ Form::button('<span class="fa fa-lg fa-save"></span> Simpan', array('class'=>'btn btn-success btn-lg', 'type'=>'submit')) }}
                        </div>
                    <div>
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
</script>
@endsection