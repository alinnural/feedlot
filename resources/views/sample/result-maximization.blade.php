@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="/" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <h4> Hasil Optimasi </h4>
                </div>
                <div class="panel-body">
                    <h4>Inisialisasi Tableau</h4>
                    <table class="table table-bordered">
                        @for($i=0;$i <= $maximization->get_num()[1];$i++)
                        <tr>
                            @for($j=0;$j<=$maximization->get_total_number()+1;$j++)
                                <td>{{ $initial_tableau[$i][$j] }}</td>
                            @endfor
                        </tr>
                        @endfor
                    </table>

                    <h4>Solusi Dasar</h4>
                    <table class="table table-bordered">
                        <tr>
                            @for($i=0; $i<=$maximization->get_total_number(); $i++)
                                <!-- the $ctr would be the variable that would count the number of 1s in the row -->
                                @php $ctr=0; @endphp
                                @for($j=0; $j<=$maximization->get_num()[1]; $j++)
                                    <!-- if it encounters a non-zero, check if the value of the non-zero is 1 -->
                                    @if($initial_tableau[$j][$i]!=0)
                                        <!-- if it encounters a 1 in the array, increment $ctr and assign $j to $index -->
                                        @if($ctr==0 && $valuesArray[$j][$i]==1)
                                            @php 
                                            $index=$j;
                                            $ctr++;
                                            @endphp
                                        <!-- if it is not equal to 1, or there are more than one 1s in the row, stop the loop -->
                                        @else
                                            @break
                                    @endif
                                @endfor
                                <!-- if $ctr is exactly equal to 1, it means that the column is cleared, meaning there is one row that has a value of 1 and the rest is zero -->
                                @if($ctr==1)
                                    <!-- check if $i+1 <=$num[0], if this is true, value it is getting is for the Xs -->
                                    @if(($i+1)<=$maximization->get_num()[0])
                                        @php $sub=$i+1; @endphp;
                                        <td> x{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1]}}</td>
                                    
                                    //if not, the value it is getting is for the slack variables and the z
                                    @else
                                        @php $sub = $i - $maximization->get_num()[0]+1; @endphp
                                        <!--if $sub<=$num[1], the values are for the slack variables-->
                                        @if($sub<=$maximization->get_num()[1])
                                            <td> s{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1]}}</td>
                                        //if not, then the value is for z
                                        @else
                                            <td> z = {{ $initial_tableau[$index][$maximization->get_total_number+1]}}</td>
                                        @endif
                                    @endif
                                <!--if $ctr!=1, then the column is not cleared, the variables would have a value of 0 -->
                                @else
                                    @if(($i+1)<=$maximization->get_num()[0])
                                        @php $sub=$i+1; @endphp
                                        <td> x{{ $sub }}} = 0</td>
                                    
                                    @else
                                        @php $sub=$i-$maximization->get_num()[0]+1; @endphp
                                        @if($sub<=$maximization->get_num()[1])
                                            <td> s{{ $sub }} = 0</td>
                                        @else
                                            <td> z = 0</td>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        </tr>
                    </table>

                    <!-- display the basic solution for the problem -->
                    <h4>Solusi Dasar</h4>
                    <table class="table table-bordered">
                        <tr>
                        @for($i=0; $i<=$n; $i++)
                            <!-- the $ctr would be the variable that would count the number of 1s in the row -->
                            @php $ctr=0; @endphp
                            @for($j=0; $j<=$maximization->get_num()[1]; $j++)
                                <!-- if it encounters a non-zero, check if the value of the non-zero is 1 -->
                                @if($initial_tableau[$j][$i]!=0)
                                    <!-- if it encounters a 1 in the array, increment $ctr and assign $j to $index-->
                                    @if($ctr==0 && $initial_tableau[$j][$i]==1)
                                        @php
                                        $index=$j;
                                        $ctr++;
                                        @endphp
                                    <!-- if it is not equal to 1, or there are more than one 1s in the row, stop the loop -->
                                    @else
                                        @break
                                @endif
                            @endfor
                            <!-- if $ctr is exactly equal to 1, it means that the column is cleared, meaning there is one row that has a value of 1 and the rest is zero -->
                            @if($ctr==1)
                                <!-- check if $i+1 <=$num[0], if this is true, value it is getting is for the Xs -->
                                @if(($i+1)<=$maximization->get_num()[0])
                                    @php $sub=$i+1; @endphp
                                    <td> x{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1]}}</td>
                                <!-- if not, the value it is getting is for the slack variables and the z -->
                                @else
                                    @php $sub=$i-$maximization->get_num()[0]+1; @endphp
                                    <!-- if $sub<=$num[1], the values are for the slack variables -->
                                    @if($sub<=$maximization->get_num()[1])
                                        <td> s{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1] }}</td>
                                    <!-- if not, then the value is for z -->
                                    @else
                                        <td> z = {{ $initial_tableau[$index][$maximization->get_total_number()+1] }}</td>
                                    @endif
                                @endif
                            <!-- if $ctr!=1, then the column is not cleared, the variables would have a value of 0 -->
                            @else
                                @if(($i+1)<=$maximization->get_num()[0])
                                    @php $sub=$i+1; @endphp
                                    <td> x{{ $sub }} = 0</td>
                                @else
                                    @php $sub = $i - $maximization->get_num()[0]+1; @endphp
                                    @if($sub <= $maximization->get_num()[1])
                                        <td> s{{ $sub }} = 0</td>
                                    @else
                                        <td> z = 0</td>
                                    @endif
                                @endif
                            @endif
                        @endfor
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <tr>
                            @for($i=0; $i<=$maximization->get_total_number(); $i++)
                                <!-- the $ctr would be the variable that would count the number of 1s in the row -->
                                @php $ctr=0; @endphp
                                @for($j=0; $j<=$num[1]; $j++)
                                    <!-- if it encounters a non-zero, check if the value of the non-zero is 1 -->
                                    @if($valuesArray[$j][$i]!=0)
                                        <!-- if it encounters a 1 in the array, increment $ctr and assign $j to $index -->
                                        @if($ctr==0 && $initial_tableau[$j][$i]==1)
                                            @php
                                            $index=$j;
                                            $ctr++;
                                            @endphp
                                        <!-- if it is not equal to 1, or there are more than one 1s in the row, stop the loop -->
                                        @else
                                            @break
                                        @endif
                                    @endif
                                @endfor
                                <!-- if $ctr is exactly equal to 1, it means that the column is cleared, meaning there is one row that has a value of 1 and the rest is zero -->
                                @if($ctr==1)
                                    <!-- check if $i+1 <=$num[0], if this is true, value it is getting is for the Xs -->
                                    @if(($i+1)<=$maximization->get_num()[0])
                                        @php $sub=$i+1; @endphp
                                        <td> x{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1] }}</td>
                                    <!-- if not, the value it is getting is for the slack variables and the z -->
                                    @else
                                        @php $sub=$i-$maximization->get_num()[0]+1; @endphp
                                        <!-- if $sub<=$num[1], the values are for the slack variables -->
                                        @if($sub<=$maximization->get_num()[1])
                                            <td> s{{ $sub }} = {{ $initial_tableau[$index][$maximization->get_total_number()+1] }}</td>
                                        <!-- if not, then the value is for z -->
                                        @else
                                            <td> z = {{ $initial_tableau[$index][$maximization->get_total_number()+1] }}</td>
                                        @endif
                                    @endif
                                <!-- if $ctr!=1, then the column is not cleared, the variables would have a value of 0 -->
                                @else
                                    @if(($i+1)<=$num[0])
                                        @php $sub=$i+1; @endphp
                                        <td> x{{ $sub }} = 0</td>
                                    @else
                                        @php $sub = $i - $maximization->get_num()[0]+1; @phpend
                                        @if($sub<=$maximization->get_num()[1])
                                            <td> s{{ $sub }} = 0</td>
                                        @else
                                            <td> z = 0</td>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        </tr>
                    </table>

                    @include('sample.table-iteration-maximization')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection