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
</form>
</body>
</html>
