<?php include("library.php");?>
<html>
	<head>
		<title>Diet Problem Solver</title>
		<link rel="stylesheet" type="text/css" href="css/dietProblemSolverCSS.css" />
		<style>
			body{
				background-color:#E8E8E8;
				background:url('background/bg.jpg');
				background-attachment:fixed;
			}
		</style>
	</head>
	<body>
		<div id="back">
			<a href="dietproblemsolver.php" title="Back to Diet Problem Solver" class="links">Diet Problem Solver</a>
		</div>
		<div id="header1">
			<a class="heading">Solution:</a>
		</div>
	<div>
		<?php
			$input = $_POST['chosenFoods'];

			$pagkain = array();
			$tokenCtr=0;
			$token = strtok($input, ',');
			while($token)
			{
				$pagkain[$tokenCtr++]=$token;
				$token = strtok(',');
			}
			
			$myList = new FoodList();
			$myList->getFoodDetails();
			$selected = $myList->searchFoods($pagkain);
		
			$manager=new simplexMethod;
			$flag=0;
			
			//number of selected items
			$n=count($selected);
			$genArray=array();
			
			//displays all the selected foods
			echo "<p>Selected Foods: </p>";
			echo "<table id='myTable'>";
			echo "<tr>";
			for($i=1; $i<=$n; $i++)
			{
				echo "<td>".$selected[$i-1]->getName()."</td>";
				if($i%4==0)
				{
					echo "</tr><tr>";
				}
				if($i==$n)
					echo "</tr>";
			}
			echo "</table>";
			echo "<br />";
			
			//assigns the values to an array
			$calories = array();
			for($i=0; $i<$n; $i++)
				$calories[$i]=floatval($selected[$i]->getCalories());
			$cholesterol = array();
			for($i=0; $i<$n; $i++)
				$cholesterol[$i]=floatval($selected[$i]->getCholesterol());
			$totalFat = array();
			for($i=0; $i<$n; $i++)
				$totalFat[$i]=floatval($selected[$i]->getTotalFat());
			$sodium = array();
			for($i=0; $i<$n; $i++)
				$sodium[$i]=floatval($selected[$i]->getSodium());
			$carbs = array();
			for($i=0; $i<$n; $i++)
				$carbs[$i]=floatval($selected[$i]->getCarbohydrates());
			$dietaryFiber = array();
			for($i=0; $i<$n; $i++)
				$dietaryFiber[$i]=floatval($selected[$i]->getDietaryFiber());
			$protein = array();
			for($i=0; $i<$n; $i++)
				$protein[$i]=floatval($selected[$i]->getProtein());
			$vitaminA = array();
			for($i=0; $i<$n; $i++)
				$vitaminA[$i]=floatval($selected[$i]->getVitaminA());
			$vitaminC = array();
			for($i=0; $i<$n; $i++)
				$vitaminC[$i]=floatval($selected[$i]->getVitaminC());
			$calcium = array();
			for($i=0; $i<$n; $i++)
				$calcium[$i]=floatval($selected[$i]->getCalcium());
			$iron = array();
			for($i=0; $i<$n; $i++)
				$iron[$i]=floatval($selected[$i]->getIron());
			$price = array();
			for($i=0; $i<$n; $i++)
				$price[$i]=floatval($selected[$i]->getPrice());
			$minimumValues = array(2000,0,0,0,0,25,50,5000,50,800,10);
			$maximumValues = array(2250, 300, 65, 2400, 300, 100, 100, 50000, 20000, 1600, 30);
			
			//add the coefficients of the constraints to the array(less than or equal to)
			for($ctr=0; $ctr<$n; $ctr++)
			{
				$genArray[0][$ctr]=$calories[$ctr];
				$genArray[1][$ctr]=$cholesterol[$ctr];
				$genArray[2][$ctr]=$totalFat[$ctr];
				$genArray[3][$ctr]=$sodium[$ctr];
				$genArray[4][$ctr]=$carbs[$ctr];
				$genArray[5][$ctr]=$dietaryFiber[$ctr];
				$genArray[6][$ctr]=$protein[$ctr];
				$genArray[7][$ctr]=$vitaminA[$ctr];
				$genArray[8][$ctr]=$vitaminC[$ctr];
				$genArray[9][$ctr]=$calcium[$ctr];
				$genArray[10][$ctr]=$iron[$ctr];
			}
			//add the coefficients of the constraints to the array (greater than or equal to)
			for($ctr=0; $ctr<$n; $ctr++)
			{
				$genArray[11][$ctr]=$calories[$ctr]*-1;
				$genArray[12][$ctr]=$cholesterol[$ctr]*-1;
				$genArray[13][$ctr]=$totalFat[$ctr]*-1;
				$genArray[14][$ctr]=$sodium[$ctr]*-1;
				$genArray[15][$ctr]=$carbs[$ctr]*-1;
				$genArray[16][$ctr]=$dietaryFiber[$ctr]*-1;
				$genArray[17][$ctr]=$protein[$ctr]*-1;
				$genArray[18][$ctr]=$vitaminA[$ctr]*-1;
				$genArray[19][$ctr]=$vitaminC[$ctr]*-1;
				$genArray[20][$ctr]=$calcium[$ctr]*-1;
				$genArray[21][$ctr]=$iron[$ctr]*-1;
			}
			
			//add the minimum and maximum values to the matrix
			for($ctr=0; $ctr<11; $ctr++)
				$genArray[$ctr][$n]=$minimumValues[$ctr];
			for($ctr=11, $i=0; $ctr<22, $i<11; $ctr++, $i++)
				$genArray[$ctr][$n]=$maximumValues[$i]*-1;
			
			//add the minimum number of servings per selected food to the matrix
			for($i=22, $k=0; $i<$n+22; $i++, $k++)
			{
				for($j=0; $j<=$n; $j++)
				{
					if($k!=$j)
						$genArray[$i][$j]=0;
					else
						$genArray[$i][$j]=1;
				}
			}
			
			//add the maximum number of servings per selected food to the matrix
			for($i=$n+22, $k=0; $i<2*$n+22; $i++, $k++)
			{
				for($j=0; $j<=$n; $j++)
				{
					if($k!=$j)
					{
						if($j==$n)
							$genArray[$i][$j]=-10;
						else
							$genArray[$i][$j]=0;
					}
					else
						$genArray[$i][$j]=-1;
				}
			}
			
			//add the coefficient of the objective function to the matrix
			for($i=0; $i<=$n; $i++)
			{
				if($i!=$n)
					$genArray[(2*$n)+22][$i]=$price[$i];
				else
					$genArray[(2*$n)+22][$i]=0;
			}
			
			//since we are minmizing a function, we need the form the dual problem to convert the current minimization problem to a maximization one
			$genArray=$manager->transposeMatrix($genArray, (2*$n)+22, $n);
			
			//multiply all the elements in the last row by -1
			for($i=0; $i<=(2*$n)+22; $i++)
				$genArray[$n][$i]*=-1;
			
			//add slack variables to the matrix
			for($i=0; $i<=$n; $i++)
			{
				$k=0;
				for($j=(2*$n)+22; $j<=(3*$n)+22; $j++)
				{
					if($k!=$i)
						$genArray[$i][$j]=0;
					else
						$genArray[$i][$j]=1;
					$k++;
				}
			}
			
			//add the price to the matrix
			for($i=0; $i<=$n; $i++)
			{
				if($i!=$n)
					$genArray[$i][(3*$n)+23]=$price[$i];
				else
					$genArray[$i][(3*$n)+23]=0;
			}
			
			//the maximum number of iteratiions is 100, if it exceeds the maximum, the problem is infeasible
			for($max=0; $max<100; $max++)
			{
				//get the column with the smallest value in the last row
				$minCol=$manager->getMinimumColumn($genArray, $n, (3*$n)+22);
				//if there are no negative values, the problem is already minimized
				if($minCol==(3*$n)+24)
					break;
				
				//get the index of the row with the smallest ratio a/b -> a is the rightmost column and b is the positive entry from the minCol
				$minRow=$manager->getMinimumRow($genArray, $n, $minCol, (3*$n)+22);
				//if there are no non-negative or zero, the problem is infeasible
				if($minRow==$n)
				{
					$flag=1;
					echo "<div id='infeasible'><p>Problem is infeasible.</p></div>";
					break;
				}
				
				//normalize the pivot row
				//divide the pivot row by the pivot element
				for($i=0; $i<=(3*$n)+23; $i++)
					if($i!=$minCol)
						$genArray[$minRow][$i]=$genArray[$minRow][$i]/$genArray[$minRow][$minCol];
				$genArray[$minRow][$minCol]=1;
				
				//make the rest of the elements of the pivot column 0
				for($i=0; $i<=$n; $i++)
				{
					if($i!=$minRow)
					{
						for($j=0; $j<=(3*$n)+23; $j++)
							if($j!=$minCol)
								$genArray[$i][$j]=$genArray[$i][$j]-($genArray[$i][$minCol]*$genArray[$minRow][$j]);
							$genArray[$i][$minCol]=0;
					}
				}
			}
			if($max==100)
				echo "<div id='infeasible'><p>Problem is infeasible.</p></div>";
			if($minRow!=$n && $flag=1)
			{
				echo "<p>The cost of this <i>optimal</i> diet is $".$genArray[$n][(3*$n)+23]." per day.</p>";
				echo "<table border='1' id='myTable'>";
				echo "<tr>
				<th>Food</th>
				<th>Servings</th>
				<th>Cost($)</th>
				</tr>";
				for($j=(2*$n)+22, $i=0; $j<(3*$n)+22; $j++, $i++)
				{
					if($genArray[$n][$j]!=0)
					{
						$cost=floatval($selected[$i]->getPrice())*$genArray[$n][$j];
						echo "<tr>";
						echo "<td>".$selected[$i]->getName()."</td>";
						echo "<td>".$genArray[$n][$j]."</td>";
						echo "<td>".$cost."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			}
		?>
	</div>
	<div id="footer">
			Copyright &copy;2012. Karizza N Crespo. 2010-00094. All rights reserved.
		</div>
	</body>
</html>