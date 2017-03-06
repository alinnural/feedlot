@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="/home" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <h4><i class="fa fa-breafcase"></i> Hasil Optimasi </h4>
                </div>
                <div class="panel-body">
                    @if(Auth::check())
                    <a class="btn btn-warning" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-list-alt"></i> Lihat Hasil Perhitungan Matriks
                    </a>
                    @endif
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
                                        <td id='each'>{{ round($initial_tableau[$i][$j],3) }}</td>
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
                                            $nutrients[$sub] = round($initial_tableau[$num[0]][$i],3);
                                            @endphp
                                            <td id='each'> y{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],3) }}</td>
                                            
                                        @else
                                            @php $sub=$i-$num[1]+1; @endphp
                                            @if($sub<=$num[0])
                                                <td id='each'> x{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],3) }}</td>
                                                @php $feeds[$sub] = round($initial_tableau[$num[0]][$i],3); @endphp
                                            @else
                                                <td id='each'> z = {{ round($initial_tableau[$num[0]][$total_number+1],3) }}</td>
                                            @endif
                                        @endif
                                        @php 
                                        $harga_terakhir = round($initial_tableau[$num[0]][$total_number+1],3);
                                        @endphp
                                    @endfor
                                    </tr>
                                </table>
                            @endfor
                            <!-- if the number of iterations reaches 100, the problem is infeasible -->
                            @if($max==100)
                                <p class='final'>Tidak Mungkin (Problem is infeasible). </p>
                            @endif

                            @if($minRow!=$total_number && $flag!=1)
                                <!-- display the final table -->
                                <p class='final'>Final Tableau: </p>
                                <table class="table table-bordered">
                                    @for($i=0;$i<=$num[0];$i++)
                                    <tr>
                                        @for($j=0;$j<=$total_number+1;$j++)
                                            <td>{{ round($initial_tableau[$i][$j],3) }}</td>
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
                                            $nutrients[$sub] = round($initial_tableau[$num[0]][$i],3);
                                            @endphp
                                            <td>y{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],3) }}</td>
                                        @else
                                            @php $sub = $i- $num[1]+1; @endphp
                                            @if($sub <= $num[0])
                                                <td>x{{ $sub }} = {{ round($initial_tableau[$num[0]][$i],3) }}</td>
                                                @php $feeds[$sub] = round($initial_tableau[$num[0]][$i],3); @endphp
                                            @else
                                                <td>z = {{ round($initial_tableau[$num[0]][$total_number+1],3) }}</td>
                                            @endif
                                        @endif
                                        @php $harga_terakhir = round($initial_tableau[$num[0]][$total_number+1],3); @endphp
                                    @endfor
                                    </tr>
                                </table>
                            @endif
                        </div>              
                    </div>
                    <br>&nbsp;<br>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <table class="table table-stripped">
                                    <tr>
                                        <td width="300"><strong><h4>{!! Form::label('var', 'Harga Terakhir', ['class' => 'control-label']) !!}</strong></h4></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><strong><h4><span class="pull-left">IDR</span> <span class="pull-right">{{ $harga_terakhir }}</span></h4></strong></td>
                                    </tr>
                                    @foreach (Calculate::mapping_feed_id_result(Session::get('feed_id'),Session::get('feed_price'),$feeds) as $feed)
                                    <tr>
                                        <td><label class="control-label">{{ $feed['name'] }}</label></td>
                                        <td><strong class="pull-right">{{ $feed['result'] * 100 }}</strong></td>
                                        <td><strong class="pull-left">%</strong></td>
                                        <td><span class="pull-left">IDR</span> <span class="pull-right">{{ $feed['price'] }}</span></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{--<div class="col-md-6">
                            <div class="panel panel-default">
                                <table class="table table-stripped">
                                    @foreach (Calculate::mapping_nutrient_id_result(Session::get('requirement_id'),$nutrients) as $nu)
                                    <tr>
                                        <td><label class="control-label">{{ $nu['name'] }}</label></td>
                                        <td><strong class="pull-right">{{ $nu['result'] * 100 }}</strong></td>
                                        <td><strong class="pull-left">%</strong></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>--}}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Kebutuhan Nutrisi Sapi Pedaging</div>
                                <table class="table table-stripped">
                                    <tr>
                                        <td width="300">{!! Form::label('var', 'Animal Type', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->animal_type}}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('var', 'Current Weight', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->current}} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('var', 'Finish Weight', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->finish}} Kg</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('var', 'ADG (Average Daily Gain)', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->adg}}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('var', 'DMI (Dry Matter Intake)', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->tdn}}</td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('var', 'TDN (Total Digestible Nutrient)', ['class' => 'control-label']) !!}</td>
                                        <td>{{ $requirement[0]->dmi}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>         
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