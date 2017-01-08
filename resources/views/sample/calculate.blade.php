@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <a href="/welcome" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <h4> Hasil Optimasi </h4>
                </div>
                <div class="panel-body">
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

                    @include('front.table-iteration-using-class')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection