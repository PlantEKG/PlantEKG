<!DOCTYPE HTML>
<html>
<!-- CSS FILE -->
<!-- <link type="text/css" rel="stylesheet" href="main.css"> -->
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
<form method="POST" action="add_user_to_database.php" method="POST">
<<<<<<< HEAD
			Full Name: <input type="textbox" name="name"><br>
			Email: <input type="textbox" name="email"><br>
			Phone: <input type="textbox" name="phone_number"><br>
			Password: <input type="textbox" name="password"><br>
			Hr: <select name = "hour">
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
             Min:
             <select name = "min">
               <option value = 0>00</option>
               <option value = 15>15</option>
               <option value = 30>30</option>
               <option value = 45>45</option>
             </select>
             AM/PM: <select name = "AMPM">
               <option value = "AM">AM</option>
               <option value = "PM">PM</option>
           </select>
			<input type="submit" value="Submit">
=======
		<fieldset>
			<legend>Create New Account</legend>
			<label for='username' >Username:</label>
			<input type='text' name='name' id='name'  maxlength="50" />
			<label for='email' >Email:</label>
			<input type='text' name='email' id='email' maxlength="50" />
			<label for='phone_number' >Phone Number:</label>
			<input type='text' name='phone_number' id='phone_number'  maxlength="50" />
			<label for='password' >Password:</label>
			<input type='text' name='password' id='password' maxlength="50" />
			<br>
			<input type='submit' name='Submit' value='Submit' />
		</fieldset>
>>>>>>> bd947ab0f1262bd96a0d659bf9e2805628b64525
</form>
</body>
</html>
