<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="assignment2.css" type="text/css">

<title>Week 2 - Assignment</title>
</head>
<body>
	<div id="mainwrapper">
		<h1>Week 2 - Assignment</h1>
		<h3><center>Prime numbers pattern recognition</center></h3>
	<div id="subdiv-main">
		<h5>Try to find a pattern as to why prime numbers end in certain digits. Is there a coorelation? If we calculated infinite primes would they end with the same frequency of digits? Each box of color represents a prime number, and each color represents the same last digit. Take a look: </h5>
		
		<?php
		
		    $prime = 1;
			$one = 0;
			$two = 0;
			$three = 0;
			$four = 0;
			$five = 0;
			$six = 0;
			$seven = 0;
			$eight = 0;
			$nine = 0;
			
			$cols = 60;
			
			echo "<small>";
			echo "<table border=\"0\">";
			for ($i = 0; $i < 150; $i++)
			{		
					echo "<tr>";
			
			    for ($j = 0; $j < $cols; $j++)
				{
					
					
					$nextprime = gmp_nextprime($prime);
					
					
					$primearray = str_split(gmp_strval($prime));
					$primedigits = strlen(gmp_strval($prime));
					$num = $primearray[$primedigits - 1];
					
					switch($num)
					{
						case 1:
							echo "<td class='one'>";
							$one+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 2:
							echo "<td>";
							$two+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 3:
							echo "<td class='three'>";
							$three+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 4:
							echo "<td>";
							$four+=1;
							echo gmp_strval($prime);
							echo ", ";
							echo "</td>";
							break;
						case 5:
							echo "<td>";
							$five+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 6:
							echo "<td>";
							$six+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 7:
							echo "<td class='seven'>";
							$seven+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 8:
							echo "<td>";
							$eight+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						case 9:
							echo "<td class='nine'>";
							$nine+=1;
							echo gmp_strval($prime);
							echo "</td>";
							break;
						default:
							echo "</td>";
							break;

	
					}
					
					$prime = $nextprime;
				}
				
					echo "</tr>";
			}
			
			echo "</table>";
			echo "</small>";
			echo "</div>";
			
			echo "<div id=\"subdiv-alt\">";
			
			echo "<p>";
			echo "$one primes ended in 1.";
			echo "<br>";
			echo "$two primes ended in 2.";
			echo "<br>";
			echo "$three primes ended in 3.";
			echo "<br>";
			echo "$four primes ended in 4.";
			echo "<br>";
			echo "$five primes ended in 5.";
			echo "<br>";
			echo "$six primes ended in 6.";
			echo "<br>";
			echo "$seven primes ended in 7.";
			echo "<br>";
			echo "$eight primes ended in 8.";
			echo "<br>";
			echo "$nine primes ended in 9.";
			
			echo "</div>";
		?>
		
		
	</div>
</body>
</html>