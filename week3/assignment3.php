<?php
	$errorMessage = "";
	$name = "";
	$title = "";
	$manager = "";
	$empType = "";
	$startdate = "";
	$enddate = "";
	$equipment = "";
?> 

<!DOCTYPE html>
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Assignment 3</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>

<html>
	<body>
		<div id="maindiv">
			<h1>New Hire Form</h1>
			<br />
			<div id="subdiv">
				<h2><center>Information</center></h2>
				<p>
					<form method="post" action="">
						Name: 
						<br />
						<input type="text" name="name" size="12" />
						<br />
						Title:
						<br />
						<input type="text" name="title" size="12" />
						<br />
						Manager:
						<br />
						<input type="text" name="manager" size="12" />
						<br />
						Start Date:
						<br />
						<input type="text" name="startdate" size="12" />
						<br />
						End Date:
						<br />
						<input type="text" name="enddate" size="12" />
						<br />
						Equipment:
						<br />
						<select name="equipment" >
						  <option value="standard">Standard Laptop</option>
						  <option value="macbook">MacBook Pro</option>
						  <option value="desktop">Standard Desktop</option>
						  <option value="helaptop">High-end Laptop</option>
						</select>
						<br />
						
						<p>
						Employee Type
						<br />
						<input type="radio" name="employeeType" value="fulltime" />FTE <br />
						<input type="radio" name="employeeType" value="consultant" />Consultant <br />
						<input type="radio" name="employeeType" value="contractor" />Contractor <br />
						<input type="radio" name="employeeType" value="temp" />Temp <br />
						<br />
						Additional Comments:
						<br />
						<textarea name="comments" placeholder="e.g. Special requests/considerations, larger monitor, wireless mouse, etc."></textarea>
						<br />
						Email Confirmation:
						<br />
						<input type="email"	name="email" value="" />
						<br />
						
						<input type="submit" name="submit" value="Submit" />
						<input type="reset" value="Reset" />
						</div>
					<div id="subdiv2">
						<h2><center>Confirmation</center></h2>
						<br />
						<p>
					<?php
						
						if(isset($_POST['submit'])) 
						{
							
						   	$name = $_POST['name'];
						   	$title = $_POST['title'];
						   	$manager = $_POST['manager'];
							$startdate = $_POST['startdate'];
							$enddate = $_POST['enddate'];
							$equipment = $_POST['equipment'];
							$comments = $_POST['comments'];

							if(!empty($_POST['employeeType']))
							{
								$empType = $_POST['employeeType'];
								
							}
							else {
								$empType = "";
							}
						
							$empData = array();
							array_push($empData,$name);
							array_push($empData,$title);
							array_push($empData,$manager);
							array_push($empData,$startdate);
							array_push($empData,$enddate);
							array_push($empData,$equipment);
							array_push($empData,$comments);
							array_push($empData,$empType);
							
							compact($empData);
							
							echo "Number of elements in Array: ";
							echo count($empData);
							?>
							
							
							<br />
							<h4>Name: <?= $empData[0] ?></h4>
							<p />
							<h4>Title: <?= $empData[1] ?></h4>
							<p />
							<h4>Manager: <?= $empData[2] ?></h4>
							<p />
							<h4>Start Date: <?= $empData[3] ?></h4>
							<p />
							<h4>End Date: <?= $empData[4] ?></h4>
							<p />
							<h4>Equipment: <?= $empData[5] ?></h4>
							<p />
							<h4>Employee Type: <?= $empData[6] ?></h4>
							<p />
							<h4>Comments: <?= $empData[7] ?></h4>
							<p />
							
							<?php
							echo "Array: (";
							foreach($empData as $item){
								echo $item . ",";

							}
							echo ").";
							
							echo "<br>";

						    if(empty($name)) {
							      $errorMessage .= "<li>You forgot to enter a name!</li>";
							   }
							if(empty($title)) {
							      $errorMessage .= "<li>You forgot to enter a title!</li>";
							   }
							if(empty($manager)) {
							      $errorMessage .= "<li>You forgot to enter a manager!</li>";
							   }
							if(empty($startdate)) {
							      $errorMessage .= "<li>You forgot to enter a start date!</li>";
							   }
							if(empty($enddate)) {
							      $errorMessage .= "<li>You forgot to enter an end date!</li>";
							   }
							if(empty($empType)) {
							      $errorMessage .= "<li>You forgot to select the employee type!</li>";
							   }
						}
						
					?>			
						

					</p>
				</form>
				<?=	$errorMessage ?>
			</p>
			</div>
		</div>
		
	</body>
</html>