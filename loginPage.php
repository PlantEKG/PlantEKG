<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>
</head>
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

<body>

<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
	<fieldset>
		<legend>Login</legend>
		<label for='username' >Username:</label>
		<input type='text' name='username' id='username'  maxlength="50" />
		<label for='password' >Password:</label>
		<input type='password' name='password' id='password' maxlength="50" />
		<br>
		<input type='submit' name='Submit' value='Submit' />
		<br>
		<a href="http://ec2-107-20-111-184.compute-1.amazonaws.com/brian/PlantEKG/adduser.php">new user?</a>
	</fieldset>
</form>

</body>
</html>
