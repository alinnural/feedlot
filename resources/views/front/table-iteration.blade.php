<!--the maximum number of iterations would be 100, if it excedes the maximum, the problem is infeasible -->
@for($max=0; $max<100; $max++)
    <!--get the index of the column with the smallest value-->
    @php $minCol=$simplex->getMinimumColumn($initial_tableau, $num[0], $total_number); @endphp
    <!--if there are no negative values, the problem is already minimized-->
    @if($minCol==$total_number+2)			
        @break
    @endif

    <!--get the index of the row with the smallest ratio a/b -> a is the rightmost column and b is the positive entry from the minCol-->
    @php $minRow = $simplex->getMinimumRow($initial_tableau, $num[0], $minCol, $total_number); @endphp
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
<!--//if the number of iterations reaches 100, the problem is infeasible
if($max==100)
    echo "<p class='final'>Problem is infeasible. </p>";
if($minRow!=$n && $flag!=1)
{
    //display the final table
    echo "<p class='final'>Final Tableau: </p>";
    echo "<table border='1' id='myTable'>";
    for($i=0; $i<=$num[0]; $i++)
    {
        echo "<tr>";
        for($j=0; $j<=$n+1; $j++)
            echo "<td id='each'>".$valuesArray[$i][$j]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br />";
    
    //display the final basic solution
    echo "<p class='final'>Final Basic Solution:</p>";
    echo "<table border='1' id='myTable'>
    <tr>";
    for($i=0; $i<=$n; $i++)
    {
        if(($i+1)<=$num[1])
        {
            $sub=$i+1;
            echo "<td id='each'> y".$sub." = ".$valuesArray[$num[0]][$i]."</td>";
        }
        else
        {
            $sub=$i-$num[1]+1;
            if($sub<=$num[0])
                echo "<td id='each'> x".$sub." = ".$valuesArray[$num[0]][$i]."</td>";
            else
                echo "<td id='each'> z = ".$valuesArray[$num[0]][$n+1]."</td>";
        }
    }
    echo "</tr>
    </table>";
    echo "<br />";
}-->