<?php
session_start();

if(!isset($_SESSION['username'])){
header("Location: login.php");
}


?>


<?php
require './db_connection.php';

	$error = "";
	$result = "";
	if(!isset($_SESSION['start_time'])) {
	  $_SESSION['start_time'] = time();
	  $_SESSION['start_time'] = date("H:i:s"); 
	  $today = date("Y/m/d");
	
	  $sql = "INSERT INTO auto_login(username, date, time)
	            VALUES
	            (:username, :date, :time)";
	    $stmt = $dbConn -> prepare($sql);
	    $stmt -> execute (array (":username" => $_SESSION['username'], ":date" => $today, ":time" => $_SESSION['start_time']));
	}

    if(isset($_GET['year'])) {
        $year = $_GET['year'];
    } else {
        $year = "%";
    }

    if(isset($_GET['model'])) {
        $model = $_GET['model'];
    } else {
        $model = "%";
    }

    if(isset($_GET['color'])) {
        $color = $_GET['color'];
    } else {
        $color = "%";
    }

    if(isset($_GET['plate'])) {
       $current_car = getCarInformation($_GET['plate']);
    }



    if(isset($_GET['plate'])) {
       $current_car = getCarInformation($_GET['plate']);
    }
	
	if (isset ($_GET['addVehicle'])) {
		
		if($_GET['plate1'] == ""){
			$error = "Please enter plate number!";
		}
		elseif($_GET['model1'] == "%"){
			$error = "Please select a model!";
		}
		elseif($_GET['year1'] == "%"){
			$error =  "Please select a year!";
		}
		elseif($_GET['color1'] == "%"){
			$error =  "Please select a color!";
		}
		elseif($_GET['trim1'] == "%"){
			$error =  "Please select trim!";
		}
		elseif($_GET['miles1'] == ""){
			$error = "Please enter mileage!";
		}
		else{
			$sql = "INSERT INTO car_dealership
            	(plate, year, make, model, trim, color, miles)
            	VALUES
             	(:plate, :year, :make, :model, :trim, :color, :miles)";
    		$stmt = $dbConn -> prepare($sql);
    		$stmt -> execute ( array (":plate" => $_GET['plate1'],
                              ":year" => $_GET['year1'],
                              ":make" => 'Honda',
                              ":model" => $_GET['model1'],
                              ":trim" => $_GET['trim1'],
                              ":color" => $_GET['color1'],
                              ":miles" => $_GET['miles1']));    
    		$result =  "Record was added!";  
		}
    	
	}
	
	if (isset($_GET['delete'])) { 

    $sql = "DELETE FROM car_dealership
              WHERE plate = :plate";
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute( array(":plate"=> $_GET['delete']));
    echo "Vehicle deleted!";      
	}


    function getInventory($year, $model, $color) {
        global $dbConn;
        $sql = "SELECT *
                FROM car_dealership
                WHERE year like :year
                AND model like :model
                AND color like :color";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute(array(':year' => $year, ':model' => $model, ':color' => $color));
        return $stmt->fetchAll();
    }

    function getYears() {
        global $dbConn;
        $sql = "SELECT DISTINCT year
                FROM car_dealership
                ORDER BY year DESC";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getModels() {
        global $dbConn;
        $sql = "SELECT DISTINCT model 
                FROM car_dealership
                ORDER BY model ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
	 function getTrims() {
        global $dbConn;
        $sql = "SELECT DISTINCT trim
                FROM vehicle_trim
                ORDER BY trim ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    function getColors() {
        global $dbConn;
        $sql = "SELECT DISTINCT color
                FROM car_dealership
                ORDER BY color ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getCarInformation($plate) {
        global $dbConn;
        $sql = "SELECT *
                FROM car_dealership
                LEFT JOIN vehicle_trim
                ON car_dealership.trim = vehicle_trim.trim
                WHERE plate = :plate";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute(array(':plate' => $plate));
        return $stmt->fetch();
    }
	
	function getLastLogTime($username) {
		
		global $dbConn;
		$sql = "SELECT COUNT(*) FROM auto_login WHERE username LIKE :username";
		$stmt = $dbConn -> prepare($sql);
        $stmt->execute(array(':username' => $username));
		
		if(current($stmt->fetch()) < 2)
		{
			return "Today";
		}
		
		else {	
        $sql = "SELECT time FROM auto_login WHERE username LIKE :username ORDER BY time DESC LIMIT 1,1";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute(array(':username' => $username));

		return current($stmt->fetch());
        }
	}

    function getCarCount() {
        global $dbConn;
        $sql = "SELECT COUNT(*)
                FROM car_dealership";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
	
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assignment 4 &amp; 5</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="signin.css">
        
        <script>
function confirmDelete(stadiumName) {
var remove = confirm("Do you really want to delete " + stadiumName + "?");
if (!remove) {
event.preventDefault();
}
}

function confirmLogout(event) {
var logout = confirm("Do you really want to log out?");
if (!logout) {
event.preventDefault();
}
}
</script>
 	
  </head>

  <body>
  	<div class="welcome">
<form class="logout" method="post" action="logout.php" onsubmit="confirmLogout()">
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Logout" />
</form>
<form class="pass" method="post" action="password.php" >
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Password" />
</form>
<?php echo "<p  >Welcome " . $_SESSION['name'] . "<p>";?>
<?php echo "<p  >Last login time:" . getLastLogTime($_SESSION['username']) . "<p>";?>
	</div>
    <div class="container">

      <div class="page-header">
        <h1>Assignment 4 &amp; 5</h1>
        <p class="lead">Car dealership inventory lookup.</p>
      </div>

      <?php if(isset($current_car)): ?>
          <div class="jumbotron">
              <h3><b>Showing Details for Plate: </b><? echo $current_car['plate'] ?></h3>
              <div class="row">
                  <div class="col-sm-4">
                    <h4><b>Year: </b><? echo $current_car['year'] ?></h4>
                    <h4><b>Make: </b><? echo $current_car['make'] ?></h4>
                    <h4><b>Model: </b><? echo $current_car['model'] ?></h4>
                    <h4><b>Color: </b><? echo $current_car['color'] ?></h4>
                    <h4><b>Miles: </b><? echo $current_car['miles'] ?></h4>
                  </div>
                  <div class="col-sm-4">
                    <h4><b>Trim: </b><? echo $current_car['trim'] ?></h4>
                    <h4><b>Fabric: </b><? echo $current_car['fabric'] ?></h4>
                    <h4><b>Engine: </b><? echo $current_car['engine'] ?></h4>
                    <h4><b>Rims: </b><? echo $current_car['rims'] ?></h4>
                    <h4><b>Tires: </b><? echo $current_car['tires'] ?></h4>
                  </div>
              </div>
          </div>
      <?php endif; ?>

      <div>
          <h3>Add Inventory</h3>
           <form method="get">
              <div class="row">
              	
              	<div class="col-sm-2">
                      <input class="form-control" type = "text" name = "plate1" placeholder="Plate Number" maxlength = '8'>
                      
                  </select>
                  </div>
                 <div class="col-sm-2">
                     <select class="form-control" name="model1">
                         <option value="%">Model</option>
                         <?php foreach(getModels() as $value): ?>
                             <option value="<? echo $value['model'] ?>"><? echo $value['model'] ?></option>
                         <?php endforeach; ?>
                     </select>
                 </div>
                 
                 <div class="col-sm-2">
                     <select class="form-control" id="year" name="year1">
                     	<option value="%">Year</option>
                         <?php
                          for($i = date("Y")+2; $i > 1962; $i--){
	                      echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                         ?>
                     </select>
                 </div>

                 <div class="col-sm-2">
                     <select class="form-control" name="color1">
                         <option value="%">Color</option>
                         <?php foreach(getColors() as $value): ?>
                             <option value="<? echo $value['color'] ?>"><? echo $value['color'] ?></option>
                         <?php endforeach; ?>
                     </select>
                  </div>
                  
                  <div class="col-sm-2">
                     <select class="form-control" name="trim1">
                         <option value="%">Trim</option>
                         <?php foreach(getTrims() as $value): ?>
                             <option value="<? echo $value['trim'] ?>"><? echo $value['trim'] ?></option>
                         <?php endforeach; ?>
                     </select>
                  </div>
                  
                  <div class="col-sm-2">
                      <input class="form-control" type = "text" name = "miles1" placeholder="Mileage" maxlength = "7">
                      
                  </select>
                  </div>
               
				  <div class="col-sm-2">
                      <button class="btn btn-success btn" type="submit" name ="addVehicle">Add Inventory</button>
                  </div>
               
              	        
              </div>
          </form>
          <?php
    		if ($result<>""){	
    			echo $result;
    		}	
    		else{
    			echo $error;
    		}	
    		?>
      <div>
          <h3>Filter Inventory</h3>
          <form method="get">
              <div class="row">
                  <div class="col-sm-2">
                      <select class="form-control" name="year">
                        <option value="%">Year</option>
                        <?php foreach(getYears() as $value): ?>
                            <option value="<? echo $value['year'] ?>"><? echo $value['year'] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-sm-3">
                      <select class="form-control" name="model">
                        <option value="%">Model</option>
                        <?php foreach(getModels() as $value): ?>
                            <option value="<? echo $value['model'] ?>"><? echo $value['model'] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-sm-3">
                      <select class="form-control" name="color">
                        <option value="%">Color</option>
                        <?php foreach(getColors() as $value): ?>
                            <option value="<? echo $value['color'] ?>"><? echo $value['color'] ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-sm-2">
                      <button class="btn btn-success btn" type="submit">Filter Inventory</button>
                  </div>

              </div>
          </form>
      </div>
      <h3>Inventory</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Plate</th>
            <th>Year</th>
            <th>Make</th>
            <th>Model</th>
            <th>Trim</th>
            <th>Color</th>
            <th>Miles</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach(getInventory($year, $model, $color) as $car): ?>
                <tr>
                    <th><? echo $car['plate'] ?></th>
                    <td><? echo $car['year'] ?></td>
                    <td><? echo $car['make'] ?></td>
                    <td><? echo $car['model'] ?></td>
                    <td><? echo $car['trim'] ?></td>
                    <td><? echo $car['color'] ?></td>
                    <td><? echo $car['miles'] ?></td>
                    <td>
                        <form method="get">
                            <input class="hidden" name="plate" value=<? echo $car['plate'] ?>>
                            <button class="btn btn-primary btn-xs pull-left" type="submit">View</button></td>
                        </form>
                    </td>
<td>
<form method="get">
                            <input class="hidden" name="delete" value=<? echo $car['plate'] ?>>
                            <button class="btn btn-primary btn-xs pull-left" type="submit">Delete</button></td>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      <small>Fetched <? print_r(current(getCarCount())); ?> vehicles.</small>

    </div> <!-- /container -->

  </body>
</html>
