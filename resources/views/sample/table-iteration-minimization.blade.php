@php $flag = 0; @endphp
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
            <td id='each'>{{ $initial_tableau[$i][$j] }}</td>
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
                @php $sub=$i+1; @endphp
                <td id='each'> y{{ $sub }} = {{ $initial_tableau[$num[0]][$i] }}</td>
            @else
                @php $sub=$i-$num[1]+1; @endphp
                @if($sub<=$num[0])
                    <td id='each'> x{{ $sub }} = {{ $initial_tableau[$num[0]][$i] }}</td>
                @else
                    <td id='each'> z = {{ $initial_tableau[$num[0]][$total_number+1] }}</td>
                @endif
            @endif
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
                <td>{{ $initial_tableau[$i][$j] }}</td>
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
                @php $sub = $i+1; @endphp
                <td>y{{ $sub }} = {{ $initial_tableau[$num[0]][$i] }}</td>
            @else
                @php $sub = $i- $num[1]+1; @endphp
                @if($sub <= $num[0])
                    <td>x{{ $sub }} = {{ $initial_tableau[$num[0]][$i] }}</td>
                @else
                    <td>z = {{ $initial_tableau[$num[0]][$total_number+1] }}</td>
                @endif
            @endif
        @endfor
        </tr>
    </table>
@endif