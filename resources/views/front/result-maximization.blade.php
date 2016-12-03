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
                                            @php break; @endphp
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
                                        $sub=$i-$num[0]+1;
                                        //if $sub<=$num[1], the values are for the slack variables
                                        if($sub<=$num[1])
                                            echo "<td id='each'> s".$sub." = ".$valuesArray[$index][$n+1]."</td>";
                                        //if not, then the value is for z
                                        else
                                            echo "<td id='each'> z = ".$valuesArray[$index][$n+1]."</td>";
                                    @endif
                                @endif
                                //if $ctr!=1, then the column is not cleared, the variables would have a value of 0
                                else
                                {
                                    if(($i+1)<=$num[0])
                                    {
                                        $sub=$i+1;
                                        echo "<td id='each'> x".$sub." = 0</td>";
                                    }
                                    else
                                    {
                                        $sub=$i-$num[0]+1;
                                        if($sub<=$num[1])
                                            echo "<td id='each'> s".$sub." = 0</td>";
                                        else
                                            echo "<td id='each'> z = 0</td>";
                                    }
                                }
                            @endfor
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
//display the basic solution for the problem
echo "Basic Solution:<br /><br />";
echo "<table border='1' id='myTable'>
<tr>";
for($i=0; $i<=$n; $i++)
{
    //the $ctr would be the variable that would count the number of 1s in the row
    $ctr=0;
    for($j=0; $j<=$num[1]; $j++)
    {
        //if it encounters a non-zero, check if the value of the non-zero is 1
        if($valuesArray[$j][$i]!=0)
        {
            //if it encounters a 1 in the array, increment $ctr and assign $j to $index
            if($ctr==0 && $valuesArray[$j][$i]==1)
            {
                $index=$j;
                $ctr++;
            }
            //if it is not equal to 1, or there are more than one 1s in the row, stop the loop
            else
                break;
        }
    }
    //if $ctr is exactly equal to 1, it means that the column is cleared, meaning there is one row that has a value of 1 and the rest is zero
    if($ctr==1)
    {
        //check if $i+1 <=$num[0], if this is true, value it is getting is for the Xs
        if(($i+1)<=$num[0])
        {
            $sub=$i+1;
            echo "<td id='each'> x".$sub." = ".$valuesArray[$index][$n+1]."</td>";
        }
        //if not, the value it is getting is for the slack variables and the z
        else
        {
            $sub=$i-$num[0]+1;
            //if $sub<=$num[1], the values are for the slack variables
            if($sub<=$num[1])
                echo "<td id='each'> s".$sub." = ".$valuesArray[$index][$n+1]."</td>";
            //if not, then the value is for z
            else
                echo "<td id='each'> z = ".$valuesArray[$index][$n+1]."</td>";
        }
    }
    //if $ctr!=1, then the column is not cleared, the variables would have a value of 0
    else
    {
        if(($i+1)<=$num[0])
        {
            $sub=$i+1;
            echo "<td id='each'> x".$sub." = 0</td>";
        }
        else
        {
            $sub=$i-$num[0]+1;
            if($sub<=$num[1])
                echo "<td id='each'> s".$sub." = 0</td>";
            else
                echo "<td id='each'> z = 0</td>";
        }
    }
}
echo "</tr>
</table>";

$manager=new simplexMethod;

//the maximum number of iterations would be 100, if it excedes the maximum, the problem is infeasible 
for($max=0; $max<100; $max++)
{
    //get the index of the column with the smallest value
    $minCol=$manager->getMinimumColumn($valuesArray, $num[1], $n);
    
    //if there are no negative values, the problem is already maximized
    if($minCol==$n+2)
        break;
    
    //get the index of the row with the smallest ratio a/b -> a is the rightmost column and b is the positive entry from the minCol
    $minRow=$manager->getMinimumRow($valuesArray, $num[1], $minCol, $n);
    //if there are no non-negative or zero, the problem is infeasible
    if($minRow==$num[1])
    {
        $flag=1;
        echo "<p class='final'>Problem is infeasible. </p>";
        break;
    }
    
    //display the iteration number
    $itr=$max+1;
    echo "<br />Iteration number: ".$itr."<br /><br />";
    
    //normalize the pivot row
    //divide the pivot row by the pivot element
    for($i=0; $i<=$n+1; $i++)
        if($i!=$minCol)
            $valuesArray[$minRow][$i]=$valuesArray[$minRow][$i]/$valuesArray[$minRow][$minCol];
    $valuesArray[$minRow][$minCol]=1;
    
    //make the rest of the elements of the pivot column 0
    for($i=0; $i<=$num[1]; $i++)
    {
        if($i!=$minRow)
        {
            for($j=0; $j<=$n+1; $j++)
                if($j!=$minCol)
                    $valuesArray[$i][$j]=$valuesArray[$i][$j]-($valuesArray[$i][$minCol]*$valuesArray[$minRow][$j]);
            $valuesArray[$i][$minCol]=0;
        }
    }
    
    //display the table per iteration
    echo "<table border='1' id='myTable'>";
    for($i=0; $i<=$num[1]; $i++)
    {
        echo "<tr>";
        for($j=0; $j<=$n+1; $j++)
            echo "<td id='each'>".$valuesArray[$i][$j]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br />";
    
    //display the basic solution per iteration
    echo "Basic Solution:<br /><br />";
    echo "<table border='1' id='myTable'>
    <tr>";
    for($i=0; $i<=$n; $i++)
    {
        $ctr=0;
        for($j=0; $j<=$num[1]; $j++)
        {
            if($valuesArray[$j][$i]!=0)
            {
                if($ctr==0 && $valuesArray[$j][$i]==1)
                {
                    $index=$j;
                    $ctr++;
                }
                else
                    break;
            }
        }
        if($ctr==1)
        {
            if(($i+1)<=$num[0])
            {
                $sub=$i+1;
                echo "<td id='each'> x".$sub." = ".$valuesArray[$index][$n+1]."</td>";
            }
            else
            {
                $sub=$i-$num[0]+1;
                if($sub<=$num[1])
                    echo "<td id='each'> s".$sub." = ".$valuesArray[$index][$n+1]."</td>";
                else
                    echo "<td id='each'> z = ".$valuesArray[$index][$n+1]."</td>";
            }
        }
        else
        {
            if(($i+1)<=$num[0])
            {
                $sub=$i+1;
                echo "<td id='each'> x".$sub." = 0</td>";
            }
            else
            {
                $sub=$i-$num[0]+1;
                if($sub<=$num[1])
                    echo "<td id='each'> s".$sub." = 0</td>";
                else
                    echo "<td id='each'> z = 0</td>";
            }
        }
    }
    echo "</tr>
    </table>";
    echo "<br />";
}
//if the number of iterations reaches 100, the problem is infeasible
if($max==100)
    echo "<p class='final'>Problem is infeasible. </p>";
if($minRow!=$n && $flag!=1)
{
    //display the final table
    echo "<p class='final'>Final Tableau: </p>";
    echo "<table border='1' id='myTable'>";
    for($i=0; $i<=$num[1]; $i++)
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
        $ctr=0;
        for($j=0; $j<=$num[1]; $j++)
        {
            if($valuesArray[$j][$i]!=0)
            {
                if($ctr==0 && $valuesArray[$j][$i]==1)
                {
                    $index=$j;
                    $ctr++;
                }
                else
                    break;
            }
        }
        if($ctr==1)
        {
            if(($i+1)<=$num[0])
            {
                $sub=$i+1;
                echo "<td id='each'> x".$sub." = ".$valuesArray[$index][$n+1]."</td>";
            }
            else
            {
                $sub=$i-$num[0]+1;
                if($sub<=$num[1])
                    echo "<td id='each'> s".$sub." = ".$valuesArray[$index][$n+1]."</td>";
                else
                    echo "<td id='each'> z = ".$valuesArray[$index][$n+1]."</td>";
            }
        }
        else
        {
            if(($i+1)<=$num[0])
            {
                $sub=$i+1;
                echo "<td id='each'> x".$sub." = 0</td>";
            }
            else
            {
                $sub=$i-$num[0]+1;
                if($sub<=$num[1])
                    echo "<td id='each'> s".$sub." = 0</td>";
                else
                    echo "<td id='each'> z = 0</td>";
            }
        }
    }
    echo "</tr>
    </table>";
    echo "<br />";
}