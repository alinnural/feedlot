<?php

class Food
{
	private $name;
	private $price;
	private $servingSize;
	private $calories;
	private $cholesterol;
	private $totalFat;
	private $sodium;
	private $carbohydrates;
	private $dietaryFiber;
	private $protein;
	private $vitaminA;
	private $vitaminC;
	private $calcium;
	private $iron;
	
	//constructor per food item
	function __construct($name, $price, $servingSize, $calories, $cholesterol, $totalFat, $sodium, $carbohydrates, $dietaryFiber, $protein, $vitaminA, $vitaminC, $calcium, $iron)
	{
		$this->name = $name;
		$this->price = $price;
		$this->servingSize = $servingSize;
		$this->calories = $calories;
		$this->cholesterol = $cholesterol;
		$this->totalFat = $totalFat;
		$this->sodium = $sodium;
		$this->carbohydrates = $carbohydrates;
		$this->dietaryFiber = $dietaryFiber;
		$this->protein = $protein;
		$this->vitaminA = $vitaminA;
		$this->vitaminC = $vitaminC;
		$this->calcium = $calcium;
		$this->iron = $iron;
	}
	
	//getters for the values of the nutrients of the food
	public function getName()
	{
		return $this->name;
	}
	
	public function getPrice()
	{
		return $this->price;
	}
	
	public function getServingSize()
	{
		return $this->servingSize;
	}
	
	public function getCalories()
	{
		return $this->calories;
	}
	
	public function getCholesterol()
	{
		return $this->cholesterol;
	}
	
	public function getTotalFat()
	{
		return $this->totalFat;
	}
	
	public function getSodium()
	{
		return $this->sodium;
	}
	
	public function getCarbohydrates()
	{
		return $this->carbohydrates;
	}
	
	public function getDietaryFiber()
	{
		return $this->dietaryFiber;
	}
	
	public function getProtein()
	{
		return $this->protein;
	}
	
	public function getVitaminA()
	{
		return $this->vitaminA;
	}
	
	public function getVitaminC()
	{
		return $this->vitaminC;
	}
	
	public function getCalcium()
	{
		return $this->calcium;
	}
	
	public function getIron()
	{
		return $this->iron;
	}
}

class FoodList
{
	public $listOfFoods = array();
	
	//function for getting the food details from a csv file; result is an array of objects
	public function getFoodDetails()
	{
		//opens a csv file named nutriValues.csv
		$file = fopen("nutriValues.csv", "r");
		$foodDeets;
		$ctr=0;
		
		if($file)
		{
			while(!feof($file))
			{
				//get the details per line and assign it to $foodDeets
				$foodDeets=fgetcsv($file);
				if($foodDeets[0]!='')
				{
					$this->listOfFoods[$ctr++]=new Food(
						$foodDeets[0], $foodDeets[1], $foodDeets[2], $foodDeets[3], $foodDeets[4], $foodDeets[5], $foodDeets[6], $foodDeets[7], $foodDeets[8], $foodDeets[9], $foodDeets[10], $foodDeets[11], $foodDeets[12], $foodDeets[13] 
					);
				}
			}
			fclose($file);
		}
	}
	
	//function for printing all the details of the food
	public function printFoodDetails($selectedFoods)
	{
		echo "<table border='1'>";
		echo "<tr>
			<th>CTR</th>
			<th>Name</th>
			<th>Price</th>
			<th>Serving Size</th>
			<th>Calories</th>
			<th>Cholesterol</th>
			<th>Total Fat</th>
			<th>Sodium</th>
			<th>Carbohydrates</th>
			<th>Dietary Fiber</th>
			<th>Protein</th>
			<th>Vitamin A</th>
			<th>Vitamin C</th>
			<th>Calcium</th>
			<th>Iron</th>
		</tr>";
		for($ctr=0; $ctr<count($selectedFoods); $ctr++)
		{
			echo "<tr>
			<td>".$ctr."</td>
			<td>".$selectedFoods[$ctr]->getName()."</td>
			<td>".$selectedFoods[$ctr]->getPrice()."</td>
			<td>".$selectedFoods[$ctr]->getServingSize()."</td>
			<td>".$selectedFoods[$ctr]->getCalories()."</td>
			<td>".$selectedFoods[$ctr]->getCholesterol()."</td>
			<td>".$selectedFoods[$ctr]->getTotalFat()."</td>
			<td>".$selectedFoods[$ctr]->getSodium()."</td>
			<td>".$selectedFoods[$ctr]->getCarbohydrates()."</td>
			<td>".$selectedFoods[$ctr]->getDietaryFiber()."</td>
			<td>".$selectedFoods[$ctr]->getProtein()."</td>
			<td>".$selectedFoods[$ctr]->getVitaminA()."</td>
			<td>".$selectedFoods[$ctr]->getVitaminC()."</td>
			<td>".$selectedFoods[$ctr]->getCalcium()."</td>
			<td>".$selectedFoods[$ctr]->getIron()."</td>
			</tr>";
		}
		echo "</table>";
	}
	
	//function for printing the final result
	public function printResults($selectedFoods)
	{
		echo "<table border='1'>";
		echo "<tr>
			<th>Food</th>
			<th>Servings</th>
			<th>Cost</th>
		</tr>";
		for($ctr=0; $ctr<count($selectedFoods); $ctr++)
		{
			echo "<tr>
			<td>".$selectedFoods[$ctr]->getName()."</td>
			<td>".$selectedFoods[$ctr]->getServingSize()."</td>
			<td>".$selectedFoods[$ctr]->getPrice()."</td>
			</tr>";
		}
		echo "</table>";
	}
	
	//function for making the selected foods an object and inserting it into an array; returns an array of objects
	public function searchFoods($food)
	{
		$selectedFoods = array();
		$n=0;
		
		for($ctr=0; $ctr<count($food); $ctr++)
		{
			for($anotherCtr=0; $anotherCtr<count($this->listOfFoods); $anotherCtr++)
			{
				$foods=$this->listOfFoods[$anotherCtr];
				if (strcmp($foods->getName(), $food[$ctr])==0)
					$selectedFoods[$n++]=new Food(
						$foods->getName(), $foods->getPrice(), $foods->getServingSize(), $foods->getCalories(), $foods->getCholesterol(), $foods->getTotalFat(), $foods->getSodium(), $foods->getCarbohydrates(), $foods->getDietaryFiber(), $foods->getProtein(), $foods->getVitaminA(), $foods->getVitaminC(), $foods->getCalcium(), $foods->getIron()
					);
			}
		}
		return $selectedFoods;
	}
}

class simplexMethod
{
	//function for getting the column with the smallest value; returns the index of the minimum column
	public function getMinimumColumn($valuesArray, $num, $n)
	{
		for($i=0; $i<=$n+1; $i++)
		{
			if($valuesArray[$num][$i]<0)
			{
				$index=$i;
				break;
			}
		}
		if($i==$n+2)
			return $i;
		for($i=0; $i<=$n+1; $i++)
		{
			if($valuesArray[$num][$i]<0)
			{
				if($valuesArray[$num][$i]<$valuesArray[$num][$index])
					$index=$i;
			}
		}
		return $index;
	}
	
	//function for getting the row with the smallest ratio; returns the index of the pivot row
	public function getMinimumRow($valuesArray, $num, $minCol, $n)
	{
		for($i=0; $i<$num; $i++)
		{
			if($valuesArray[$i][$minCol]>0)
			{
				$index=$i;
				break;
			}
		}
		if($i==$num)
			return $i;
		for($i=0; $i<$num; $i++)
		{
			if($valuesArray[$i][$minCol]>0)
			{
				if($valuesArray[$i][$n+1]/$valuesArray[$i][$minCol] < $valuesArray[$index][$n+1]/$valuesArray[$index][$minCol])
					$index=$i;
			}
		}
		return $index;
	}
	
	//function for transposing a matrix; returns the transposed matrix
	public function transposeMatrix($valuesArray, $rows, $cols)
	{
		$array = array();
		for($i=0; $i<=$cols; $i++)
		{
			for($j=0; $j<=$rows; $j++)
				$array[$i][$j]=$valuesArray[$j][$i];
		}
		return $array;
	}
}
?>