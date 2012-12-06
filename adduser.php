<!DOCTYPE HTML>
<html>
<!-- CSS FILE -->
<link type="text/css" rel="stylesheet" href="main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

<!-- JAVASCRIPT FILE -->
<script type="text/javascript" src="main.js"></script>
<!-- <script type="text/javascript" src="slider.js"></script> -->
<!-- JQuery for swipe -->
<!-- <script src="jquery_mobile/jquery.js"></script> -->
 <script src="js/bootstrap.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<head>
		<title>PlantEKG</title>
</head>
<body>
  <div id='header-custom'>
</div>
<br><br><br><br><br><br><br><br>
<form method="POST" name="addUser" action="add_user_to_database.php" method="POST">
		<fieldset>
			<legend style='font-size:35px;'>Create New Account</legend>
			<label for='username' style='font-size:25px;'>Username:</label>
			<input type='text' name='name' id='name' style='height:50px; width:300px;'/>
      <br>
      <br>
			<label for='email' style='font-size:25px;'>Email:</label>
			<input type='text' name='email' id='email' style='height:50px; width:300px;'/>
      <br><br>
			<label for='password' style='font-size:25px;'>Password:</label>
			<input type='text' name='password' id='password' style='height:50px; width:300px;'/>
			<h3>Notification Time</h3>
			 Hour:<select name = "hour" style='width: 75px;'>
               <option value = 1>1</option>
               <option value = 2>2</option>
               <option value = 3>3</option>
               <option value = 4>4</option> 
               <option value = 5>5</option>
               <option value = 6>6</option>
               <option value = 7>7</option>
               <option value = 8>8</option>
               <option value = 9>9</option>
               <option value = 10>10</option>
               <option value = 11>11</option>
               <option value = 12>12</option>
             </select>
			  Min:<select name = "min" style='width: 75px;'>
               <option value = 00>00</option>
               <option value = 15>15</option>
               <option value = 30>30</option>
               <option value = 45>45</option>
             </select>
             AM/PM:<select name = "AMPM" style='width: 90px;'>
               <option value = "AM">AM</option>
               <option value = "PM">PM</option>
           	</select>
           	<br><br>
			<input type='submit' class='btn btn-large' name='Submit' value='Submit' />
		</fieldset>
</form>
</body>
</html>
