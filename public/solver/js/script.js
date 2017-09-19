//myArray is the array where all the selected foods will be added
var myArray = new Array();
//allElements is an array with all the food values, this is useful when the user clicks the select all button
var allElements = ['Chocolate Chip Cookies', 'Apple Pie', 'Bagels', 'White Bread', 'Wheat Bread', 'Kellogg\'s Raisin Bran', 'Bean Bacon Soup with Water', 'New Eng Clamchowder with Milk', 'Vegetable Beef Soup', 'Tomato Soup', 'Chocolate Malt-O-Meal', 'Split Pea and Ham Soup', 'Cream of Mushroom Soup with Milk', 'New Eng Clamchowder', 'Cooked Macaroni', 'Couscous', 'Special K', 'Butter (Regular)', 'Potatoes (Baked)', 'Cheddar Cheese', 'Peanut Butter', 'White Rice', 'Air-Popped Popcorn', 'Cap\'N Crunch', 'Cheerios', 'Chicken Noodle Soup', 'Kellogg\'s Corn Flakes', 'Oatmeal', 'Oatmeal Cookies', 'Pretzels', 'Bbq Flavored Potato Chips', 'Spaghetti with Sauce', 'Rice Krispies', 'Tortilla Chips', 'Frozen Corn', 'Apple with Skin (Raw)', 'Lettuce Iceberg (Raw)', 'Tacos', 'Oranges', 'Grapes', 'Kiwifruit Fresh (Raw)', 'Frozen Broccoli', 'Banana', 'Peppers Sweet (Raw)', 'Tomato Red Ripe (Raw)', 'Carrots (Raw)', 'Celery (Raw)', 'Roasted Chicken', 'Plain Hotdog', 'Bologna Turkey', 'Frankfurter Beef', 'Kielbasa Pork', 'Pork', 'Ham Sliced Extralean', 'Sardines in Oil', 'White Tuna in Water', 'Poached Eggs', 'Tofu', 'Pizza with Pepperoni', 'Hamburger with Toppings', 'Scrambled Eggs', 'Skim Milk', '2% Lowfat Milk', '3.3% Fat Whole Milk'];

//function for adding a row to the table
function addRow(id, string)
{
	var target=document.getElementById(id);
	var row=document.createElement('tr');
	var column1=document.createElement('td');
	var column2=document.createElement('td');
	var link=document.createElement('img');
	var ctr=0;
	
	//checks if the food selected is already in the list
	for(i=0; i<myArray.length; i++)
	{
		//if it finds a match, break the loop and assign 1 to ctr
		if(myArray[i]==string)
		{
			ctr=1;
			break;
		}
	}
	
	//check if the ctr==0, if yes, the selected food is not yet in the list
	if(ctr==0)
	{
		//add the selected food to the myArray array
		myArray.push(string);
		
		//displays the name of the food in the selected food list
		column1.appendChild(document.createTextNode(string));
	
		row.id=string;
	
		column1.classList.add('foodTable');
		link.setAttribute('title', 'Remove');
		link.setAttribute('src', 'pictures/remove.jpg');
		//add an event listener
		//when the user clicks the cancel button, the name would be removed from the table and from the myArray list
		link.addEventListener('click', function(){
			var row=document.getElementById(string);
			row.parentNode.removeChild(row);
			myArray.splice(myArray.indexOf(string),1);
		}, false);
		column2.appendChild(link);
	
		row.appendChild(column1);
		row.appendChild(column2);
	
		target.appendChild(row);
	}
	//if there is a match in the list, inform the user
	else
		alert(string+" is/are already in the list.");
}

//function for adding all the food to the list
function selectAll(id)
{
	//remove first all the selected
	removeAll(id);
	//add all the elements from the allElements array
	for(var i=0; i<allElements.length; i++)
	{
		addRow(id, allElements[i]);
	}
}

//function for removing all from the list
function removeAll(id)
{
	var target=document.getElementById(id);
	
	//remove the name from the table
	for(var i=target.rows.length-1; i>0; i--)
		target.deleteRow(i);
	
	//remove the element from the array
	for(i=myArray.length; i>=0; i--)
	{
		myArray.splice(i, 1);
	}
}

//function that checks if the user chose anything
function checkPage()
{
	var target=document.getElementById('chosenFoods');
	target.value="";
	
	//if there are no elements in myArray, inform the user
	if(myArray.length==0)
	{
		alert('You didn\'t choose anything.');
		return false;
	}
	else
	{
		for(i=0; i<myArray.length; i++)
			target.value+=myArray[i]+',';
		return true;
	}
}

//function that checks if the user inputs a value
function validateFirstPart()
{
	var i=0;
	var form=document.firstPart;
	var box;
	
	for(i=0; i<2; i++)
	{
		box=form.elements[i];
		if(!box.value)
		{
			alert(box.name + " has no value!");
			box.focus();
			return false;
		}
	}
	return true;
}