<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form method="POST" action="add_user_to_database.php" method="POST">
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
</form>
</body>
</html>
