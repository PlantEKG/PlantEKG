<!DOCTYPE HTML>
<html>
<head>
<title>Plant EKG</title>

<!-- CSS FILE -->
<link type="text/css" rel="stylesheet" href="main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

<!-- JAVASCRIPT FILE -->
<script type="text/javascript" src="main.js"></script>
<script src="js/bootstrap.js"></script>

<script language="javascript"> 
function toggle(showHideDiv){
	var ele = document.getElementById(showHideDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";

  	}
	else {
		ele.style.display = "block";
	}
}

</script>

</head>
<body>
	 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <a class="brand" href="#" >PlantEKG</a>
      </div>
    </div>


    <div class="container">
	<?php
		session_start();
		$my_connection = mysql_connect('plantekg.cyj1bgdmdvpz.us-east-1.rds.amazonaws.com', 'PlantEKG', 'plantsrpeople') or die('Could not connect: ' . mysql_error()); // THIS WILL NEED TO CHANGE

	// Open database "techview"
	$database_name = 'plantekg';
	mysql_select_db($database_name) or die(mysql_error()) ;

	$table_name='plants';
	$lowercase_plant_name = strtolower($_GET['plant_name']);
	$plants_data_array = array();
	$plants_data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE plant_name='" . $lowercase_plant_name . "'");
	
	while($plants_data_hold = mysql_fetch_array($plants_data_query))
	{
		array_push($plants_data_array, $plants_data_hold);
	}
		echo "<dl>";
		echo "<br><br>";
		echo "<h3> " . ucfirst($plants_data_array[0][1]) . "</h3>";
		echo "<img src= ". $plants_data_array[0][6] . ">";
		echo "<p><b> Spacing: </b>" . $plants_data_array[0][2] . "</p>";
		echo "<p><b> Feed: </b>" . $plants_data_array[0][3] . "</p>";
		echo "<p><b> Water: </b>"  . $plants_data_array[0][4] . "</p>";
		echo "<p><b> Preferred Light: </b>" . $plants_data_array[0][5] . "</p>";
		echo "</dl>";

		$_SESSION['collection_plant'] = $plants_data_array[0][0];

	?>
	</div>
	<button class="btn btn-small" type="button"><a href=index.php>Go Back</a></button>
	<button class="btn btn-small" type="button"><a href="javascript:toggle('pot_sizes')">add to collection</a></button><br><br>
	<div id='pot_sizes' style="display: none;">
		<form method="POST" action="add_plant_to_collection.php">
                       large pot: <input type="radio" id='large pot' value='large' name='pot_size'>
                       medium pot: <input type="radio" id='medium pot' value='medium' name='pot_size'>
                       small pot: <input type="radio" id='small pot' value ='small' name='pot_size'>
                       Extra Info: <input type='textbox' name='other_info'>
                       <br><br>
                       <input type='submit' value='add'>
               </form>
	</div>



</body>
</html>