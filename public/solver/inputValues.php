<?php?>
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
			<p><a href="ultimateoptimizer.php" title="go back" class="back">Back</a></p>
			<?php
				//check of the user clicked the submit button
				if(isset($_POST['submit']))
				{
					//when the user clicks the solve button, it will redirect to the solve.php page
					echo "<form name='inputValues' action='solve.php' method='post'>";
					echo "<input type='hidden' name='numbers' value='".$_POST['var'].",".$_POST['cons'].",'/>";
					echo "<input type='radio' value='maximize' name='category' id='maxCategory' checked='checked'/><label for='maxCategory'>Maximize</label><input type='radio' value='minimize' name='category' id='minCategory'/><label for='minCategory'>Minimize</label>";
					echo "
					<br /><br />
					Objective Function: ";
					//ask the user for the coefficients of objective function, the number of variables would depend on the user input
					for($i=1; $i<=intval($_POST['var']); $i++)
					{
						echo "<input type='text' name='var".$i."' id='box'/> X".$i;
						if($i!=intval($_POST['var']))
							echo " + ";
					}
					//asks for the coefficients and constants of the constraints, the number of constraints would depend on the user input
					echo "<br /><br />Constraints:<br /><br />";
					for($k=1; $k<=intval($_POST['cons']); $k++)
					{
						for($j=1; $j<=intval($_POST['var']); $j++)
						{
							echo "<input type='text' name='cons".$k.$j."' id='box'/> X".$j;
							if($j!=intval($_POST['var']))
								echo " + ";
						}
						echo "
							<select name='sign".$k."'>
							<option value='lessThan'><=</option>
							<option value='greaterThan'>>=</option>
							</select>
							<input type='text' name='answer".$k."' id='box'/>
							</br>
							";
						echo "<br />";
					}
					echo "<input type='submit' value='Solve' name='solve' title='Solve'/></form>";
				}
			?>
		</div>
		<div id="footer">
			Copyright &copy;2012. Karizza N Crespo. 2010-00094. All rights reserved.
		</div>
	</body>
</html>