<!DOCTYPE HTML>
<html>
<head>
	<title>PlantEKG</title>
</head>
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

<body>
<div id='header-custom'>
</div>
<br><br><br><br><br><br><br><br>
<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
	<fieldset>
		<legend style='font-size:35px;'>Login to PlantEKG</legend>
		<br>
		<label for='username' style='font-size:25px;' >Email:</label>
		<input type='text' name='username' id='username'  style='height:50px; width:300px;' maxlength="100" />
		<br><br><br>
		<label for='password' style='font-size:25px;' >Password:</label>
		<input type='password' name='password' id='password' style='height:50px; width:300px;' maxlength="50" />
		<br><br>
		<input type='submit' class='btn-large' name='Submit' value='Submit' />
		<br>
		<br>
		<br>
		<br>
		<a href="http://ec2-107-20-111-184.compute-1.amazonaws.com/PlantEKG/adduser.php" style='font-size:30px;'>New User?</a>
	</fieldset>
</form>

</body>
</html>
