<?php
?>
<html>
	<head>
		<title>Ultimate Optimizer</title>
		<link rel="stylesheet" type="text/css" href="css/ultimateOptimizerCSS.css" />
		<style>
			body{
				background-color:#E8E8E8;
				background:url('background/math4.jpg');
				background-attachment:fixed;
			}
		</style>
		<script type="text/javascript" src="js/script.js"></script>
	</head>
	<body>
		<div id="back">
			<a href="dietproblemsolver.php" title="Go to Diet Problem Solver" class="links">Diet Problem Solver</a>
		</div>
		<div id="header">
			<a class="heading">Ultimate Optimizer</a>
		</div>
		<div id="body">
			<div id="first">
			<!--when the user clicks submit, it will redirect to the inputValues.php page-->
				<form name="firstPart" action='inputValues.php' onsubmit="return validateFirstPart();" method="post">
				<table id='question'>
					<tr>
						<!--ask the user how many variables would be present in the equation-->
						<td><label for="var">How many variables? </label></td>
						<td><input type="text" name="var" id="var"/></td>
					</tr>
					<tr>
						<!--ask the user how many constraints would be considered-->
						<td><label for="cons">How many constraints? </label></td>
						<td><input type="text" name="cons" id="cons"/></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Submit" /></td>
					</tr>
				</table>
				</form>
			</div>
		</div>
		<div id="footer">
			Copyright &copy;2012. Karizza N Crespo. 2010-00094. All rights reserved.
		</div>
	</body>
</html>