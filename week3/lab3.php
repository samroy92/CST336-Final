<?php

	$error1 = "";
	$gal = "";
	$oz = "";
	$result = "N/A";
	$nonNumberError = "";
	
	if (isset ($_GET['oz']))
	{
		$oz = $_GET['oz'];
		if(is_numeric($oz))
		{
			$gal = $oz * 0.00781;
		}
		else {
			$nonNumberError = "You did not enter a number silly! ";
		}
	}

	if(isset ($_GET['gal']))
	{
		$gal = $_GET['gal'];
		if(is_numeric($gal))
		{
			$convertTo = $_GET['convertTo'];
			switch($convertTo) {
				case 'qts': $result = $gal * 4;
							break;
				case 'cups': $result = $gal / 0.0625;
							break;
				case 'L': $result = $gal / 0.264;
							break;
				case '': $result = "Please try again! ";
							break;
				default:
					break;
				}
			}
		else {
			$nonNumberError = "You did not enter a number silly! ";
		}
	}
?>

<!DOCTYPE html>
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Lab3</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>

<html>
	<body>
		<div id="maindiv">
			<h1>Volume Conversion</h1>
			<form method="get">
				Enter Ounces:
				<input type="text" name="oz" size="12" />
				<input type="submit" value="Convert to Gallons" /> 
				<br />
			</form>
			<?php
			if ($gal<>"")
			{
				echo "$gal Gallons";
			}
			else {
				echo "";
			}
			?>
			<p>
				<form method="get">
					Enter Gallons: 
					<input type="text" name="gal" size="12" />
					<br />
					Convert to:
					<br />
					<input type="radio" name="convertTo" value="qts" />Quarts <br />
					<input type="radio" name="convertTo" value="cups" />Cups <br />
					<input type="radio" name="convertTo" value="L" />Liters <br />
					<input type="submit" value="Convert" />
					<br />	
				</form>
				Result: 
				<?=	$result ?>
				<?=	$nonNumberError ?>
			</p>
		</div>
		
	</body>
</html>

