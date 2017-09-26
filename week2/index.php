<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="lab2.css" type="text/css">

<title>Week 2 - Lab</title>
</head>
<body>
	<div id="mainwrapper">
		<h1>Week 2 - Lab</h1>
		<?php
		    $cols = 100;
			$even = 0;
			$odd = 0;
			echo "<small>";
			echo "<table border=\"1\">";
			
				for ($i = 0; $i < 100; $i++)
				{		
					echo "<tr>";
				
						for ($j = 0; $j < $cols; $j++)
						{
							$randnumber = rand(1,500) + rand(1,500);
							
							if(($randnumber % 2) == 0)
							{
								echo "<td class='evenstyle'>";
								$even+=1;
							}
							else 
							{
								echo "<td class='oddstyle'>";
								$odd+=1;	
							}
							
							echo "$randnumber </td>";
							
						}
						
					echo "</tr>";
				}
				
			echo "</table>";
			echo "</small>";
			
			$evenperc = $even / 100;
			$oddperc = $odd / 100;
			
			echo "<h3>";
			echo "Out of 10,000 numbers, $even of them are even. And $odd of them are odd. This equates to $evenperc% even and $oddperc% odd";
			echo "</h3>";
					
		?>
		
		
	</div>
</body>
</html>