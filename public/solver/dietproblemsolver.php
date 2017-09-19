<html>
	<head>
		<title>Diet Problem Solver</title>
		<link rel="stylesheet" type="text/css" href="css/dietProblemSolverCSS.css" />
		<style>
			body{
				background-color:#E8E8E8;
				background:url('background/restaurant.jpg');
				background-attachment:fixed;
			}
		</style>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.maphilight.min.js"></script>
		<script>
			//code for highlighting the image on hover
			$().ready(function(){  
				setInterval("checkAnchor()", 300);
				$('#container img:first').addClass('foodPics');
				$('.foodPics').maphilight({stroke:false, fillColor:'000000', fillOpacity:0.4});
			});
		</script>
	</head>
	<body>
		<div id="back">
			<a href="ultimateoptimizer.php" title="Go to Ultimate Optimizer" class="links">Ultimate Optimizer</a>
		</div>
		<a name="top"></a>
		<div id="header">
			<a class="heading">Diet Problem Solver</a>
		</div>
			<p id="instructions">&nbsp;Click on the image you want to include on your list. You can find your <a href="#body" title="See List" class="seeList">list</a> below the picture.</p>
		<div id="container">
			<img src="pictures/food.jpg" class="foodPics" usemap="#foodLinks"/>
		</div>
		<!--image mapping of foods-->
		<!--click the image to add the food to the list, you can only add the food once, to remove it from the list, click the x mark beside or click the trashcan icon to remove all-->
		<map name="foodLinks">
			<area shape="rect" coords="0, 0, 165, 165" title="Choco Chip Cookie" id="chocoChip" onmouseover="hoverImage(this)" onclick="addRow('chosenFood', 'Chocolate Chip Cookies')" />
			<area shape="rect" coords="168, 3, 248, 83" title="Apple Pie" id="applePie" onclick="addRow('chosenFood', 'Apple Pie')" />
			<area shape="rect" coords="251, 3, 331, 83" title="Bagels" id="bagels" onclick="addRow('chosenFood', 'Bagels')" />
			<area shape="rect" coords="168, 86, 248, 166" title="White Bread" id="whiteBread" onclick="addRow('chosenFood', 'White Bread')" />
			<area shape="rect" coords="251, 87, 331, 166" title="Wheat Bread" id="wheatBread" onclick="addRow('chosenFood', 'Wheat Bread')" />
			<area shape="rect" coords="334, 3, 496, 165" title="Kellogg's Raisin Bran" id="RaisinBran" onclick="addRow('chosenFood', 'Kellogg\'s Raisin Bran')" />
			<area shape="rect" coords="503, 3, 625, 125" title="Bean Bacon Soup" id="beanBaconSoup" onclick="addRow('chosenFood', 'Bean Bacon Soup with Water')" />
			<area shape="rect" coords="628, 3, 749, 125" title="Clam Chowder with Milk" id="clamChowderMilk" onclick="addRow('chosenFood', 'New Eng Clamchowder with Milk')" />
			<area shape="rect" coords="751, 3, 873, 125" title="Vegetable Beef Soup" id="vegeBeefSoup" onclick="addRow('chosenFood', 'Vegetable Beef Soup')" />
			<area shape="rect" coords="875, 3, 996, 124 " title="Tomato Soup" id="tomatoSoup" onclick="addRow('chosenFood', 'Tomato Soup')" />
			<area shape="rect" coords="875, 127, 997, 249" title="Choco Malt-O-Meal" id="maltOMeal" onclick="addRow('chosenFood', 'Chocolate Malt-O-Meal')" />
			<area shape="rect" coords="752, 127, 873, 249" title="Split Pea and Ham Soup" id="splitPea" onclick="addRow('chosenFood', 'Split Pea and Ham Soup')" />
			<area shape="rect" coords="628, 127, 749, 249" title="Cream of Mushroom Soup" id="creamOfMushroom" onclick="addRow('chosenFood', 'Cream of Mushroom Soup with Milk')" />
			<area shape="rect" coords="503, 127, 624, 249" title="New England Clam Chowder" id="newEngClamChowder" onclick="addRow('chosenFood', 'New Eng Clamchowder')" />
			<area shape="rect" coords="416, 168, 497, 249" title="Cooked Macaroni" id="cookedMacaroni" onclick="addRow('chosenFood', 'Cooked Macaroni')" />
			<area shape="rect" coords="334, 169, 413, 248" title="Couscous" id="couscous" onclick="addRow('chosenFood', 'Couscous')" />
			<area shape="rect" coords="169, 169, 333, 333" title="Special K" id="specialK" onclick="addRow('chosenFood', 'Special K')" />
			<area shape="rect" coords="86, 168, 166, 249" title="Butter" id="butter" onclick="addRow('chosenFood', 'Butter (Regular)')" />
			<area shape="rect" coords="3, 169, 84, 249" title="Baked Potatoes" id="bakedPotatoes" onclick="addRow('chosenFood', 'Potatoes (Baked)')" />
			<area shape="rect" coords="3, 252, 84, 333" title="Cheddar Cheese" id="cheddarCheese" onclick="addRow('chosenFood', 'Cheddar Cheese')" />
			<area shape="rect" coords="87, 252, 166, 333" title="Peanut Butter" id="peanutButter" onclick="addRow('chosenFood', 'Peanut Butter')" />
			<area shape="rect" coords="335, 252, 413, 333" title="White Rice" id="whiteRice" onclick="addRow('chosenFood', 'White Rice')" />
			<area shape="rect" coords="417, 252, 497, 333" title="Air-popped Popcorn" id="popcorn" onclick="addRow('chosenFood', 'Air-Popped Popcorn')" />
			<area shape="rect" coords="504, 252, 625, 373" title="Cap'n Crunch" id="capnCrunch" onclick="addRow('chosenFood', 'Cap\'N Crunch')" />
			<area shape="rect" coords="628, 252, 749, 373" title="Cheerios" id="cheerios" onclick="addRow('chosenFood', 'Cheerios')" />
			<area shape="rect" coords="752, 252, 997, 497" title="Chicken Noodle Soup" id="chickenNoodleSoup" onclick="addRow('chosenFood', 'Chicken Noodle Soup')" />
			<area shape="rect" coords="628, 376, 749, 497" title="Kellogg's Corn Flakes" id="cornFlakes" onclick="addRow('chosenFood', 'Kellogg\'s Corn Flakes')" />
			<area shape="rect" coords="503, 376, 625, 497" title="Oatmeal" id="oatmeal" onclick="addRow('chosenFood', 'Oatmeal')" />
			<area shape="rect" coords="335, 335, 497, 497" title="Oatmeal Cookies" id="oatmealCookies" onclick="addRow('chosenFood', 'Oatmeal Cookies')" />
			<area shape="rect" coords="252, 335, 331, 415" title="Pretzels" id="pretzels" onclick="addRow('chosenFood', 'Pretzels')" />
			<area shape="rect" coords="169, 335, 249, 415" title="BBQ Flavored Potato Chips" id="potatoChips" onclick="addRow('chosenFood', 'Bbq Flavored Potato Chips')" />
			<area shape="rect" coords="3, 335, 166, 495" title="Spaghetti with Sauce" id="spaghetti" onclick="addRow('chosenFood', 'Spaghetti with Sauce')" />
			<area shape="rect" coords="169, 417, 249, 497" title="Rice Krispies" id="riceKrispies" onclick="addRow('chosenFood', 'Rice Krispies')" />
			<area shape="rect" coords="251, 417, 333, 497" title="Tortilla Chips" id="tortillaChips" onclick="addRow('chosenFood', 'Tortilla Chips')" />
			<area shape="rect" coords="3, 503, 199, 699" title="Frozen Corn" id="frozenCorn" onclick="addRow('chosenFood', 'Frozen Corn')" />
			<area shape="rect" coords="202, 504, 299, 599" title="Apple with Skin" id="apple" onclick="addRow('chosenFood', 'Apple with Skin (Raw)')" />
			<area shape="rect" coords="202, 603, 299, 699" title="Iceberg Lettuce" id="icebergLettuce" onclick="addRow('chosenFood', 'Lettuce Iceberg (Raw)')" />
			<area shape="rect" coords="302, 504, 499, 699" title="Tacos" id="tacos" onclick="addRow('chosenFood', 'Tacos')" />
			<area shape="rect" coords="3, 702, 100, 799" title="Oranges" id="oranges" onclick="addRow('chosenFood', 'Oranges')" />
			<area shape="rect" coords="103, 702, 199, 799" title="Grapes" id="grapes" onclick="addRow('chosenFood', 'Grapes')" />
			<area shape="rect" coords="202, 702, 299, 799" title="Kiwi Fruit" id="kiwiFruit" onclick="addRow('chosenFood', 'Kiwifruit Fresh (Raw)')" />
			<area shape="rect" coords="302, 702, 399, 799" title="Frozen Broccoli" id="frozenBroccoli" onclick="addRow('chosenFood', 'Frozen Broccoli')" />
			<area shape="rect" coords="401, 702, 499, 799" title="Banana" id="banana" onclick="addRow('chosenFood', 'Banana')" />
			<area shape="rect" coords="301, 802, 499, 999" title="Sweet Peppers" id="sweetPeppers" onclick="addRow('chosenFood', 'Peppers Sweet (Raw)')" />
			<area shape="rect" coords="202, 802, 299, 897" title="Tomatoes" id="tomatoes" onclick="addRow('chosenFood', 'Tomato Red Ripe (Raw)')" />
			<area shape="rect" coords="202, 900, 299, 999" title="Raw Carrots" id="rawCarrots" onclick="addRow('chosenFood', 'Carrots (Raw)')" />
			<area shape="rect" coords="3, 802, 199, 999" title="Raw Celery" id="rawCelery" onclick="addRow('chosenFood', 'Celery (Raw)')" />
			<area shape="rect" coords="504, 504, 585, 585" title="Roasted Chicken" id="roastedChicken" onclick="addRow('chosenFood', 'Roasted Chicken')" />
			<area shape="rect" coords="587, 504, 667, 585" title="Plain Hotdog" id="plainHotdog" onclick="addRow('chosenFood', 'Plain Hotdog')" />
			<area shape="rect" coords="669, 504, 749, 585" title="Turkey Bologna" id="turkeyBologna" onclick="addRow('chosenFood', 'Bologna Turkey')" />
			<area shape="rect" coords="504, 587, 585, 667" title="Beef Frankfurter" id="beefFrankfurter" onclick="addRow('chosenFood', 'Frankfurter Beef')" />
			<area shape="rect" coords="587, 587, 667, 667" title="Pork Kielbasa" id="porkKielbasa" onclick="addRow('chosenFood', 'Kielbasa Pork')" />
			<area shape="rect" coords="669, 587, 749, 667" title="Pork" id="pork" onclick="addRow('chosenFood', 'Pork')" />
			<area shape="rect" coords="504, 669, 585, 749" title="Ham Sliced Extra-lean" id="slicedHam" onclick="addRow('chosenFood', 'Ham Sliced Extralean')" />
			<area shape="rect" coords="587, 669, 667, 749" title="Sardines in Oil" id="sardines" onclick="addRow('chosenFood', 'Sardines in Oil')" />
			<area shape="rect" coords="669, 669, 749, 749" title="White Tuna in Water" id="tuna" onclick="addRow('chosenFood', 'White Tuna in Water')" />
			<area shape="rect" coords="752, 504, 999, 749" title="Poached Eggs" id="poachedEggs" onclick="addRow('chosenFood', 'Poached Eggs')" />
			<area shape="rect" coords="504, 752, 749, 999" title="Tofu" id="tofu" onclick="addRow('chosenFood', 'Tofu')" />
			<area shape="rect" coords="752, 752, 831, 831" title="Pizza with Pepperoni" id="pepperoniPizza" onclick="addRow('chosenFood', 'Pizza with Pepperoni')" />
			<area shape="rect" coords="835, 752, 915, 831" title="Hamburger with Toppings" id="hamburger" onclick="addRow('chosenFood', 'Hamburger with Toppings')" />
			<area shape="rect" coords="917, 752, 999, 831" title="Scrambled Eggs" id="scrambledEggs" onclick="addRow('chosenFood', 'Scrambled Eggs')" />
			<area shape="rect" coords="752, 835, 831, 915" title="Skim Milk" id="skimMilk" onclick="addRow('chosenFood', 'Skim Milk')" />
			<area shape="rect" coords="752, 917, 831, 999" title="Low fat Milk" id="lowFatMilk" onclick="addRow('chosenFood', '2% Lowfat Milk')" />
			<area shape="rect" coords="835, 835, 915, 915" title="Milk" id="milk" onclick="addRow('chosenFood', '3.3% Fat Whole Milk')" />
			<area shape="rect" coords="917, 917, 995, 995" title="Back to top" href="#top" />
		</map>
		<div id="body">
			<a class="title">&nbsp;Foods Chosen:&nbsp;</a>
			<br />
			<table id="chosenFood" border="1">
				<tr>
					<td class="foodTable"><button onclick="selectAll('chosenFood');" class="selectAll" title="Select All">&nbsp;Select All&nbsp;</button></td>
					<td><img src="pictures/empty.jpg" title="Remove All" onclick="removeAll('chosenFood');"/></td>
				</tr>
			</table>
			<form name="listOfFoods" action="result.php" onsubmit="return checkPage();" method="post">
				<!--when the image is clicked the id would be added to the value of the hidden form input-->
				<input type="hidden" name="chosenFoods" value="" id="chosenFoods" />
				<input type="submit" value="Submit" id="submitButton" />
			</form>
		</div>
		<div id="footer">
			Copyright &copy;2012. Karizza N Crespo. 2010-00094. All rights reserved.
		</div>
	</body>
</html>