onload = load_function;
var oldHtml;
var collection_list;
var user_info;

function get_collection_from_database()
{
	var xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function()
    {

        if(xmlHttp.readyState == 4)
        {
            var collection_labels_string = xmlHttp.responseText;
            collection_list = eval ("({'data_ii':" + collection_labels_string  + "})");
        }
    }

    xmlHttp.open("GET", 'get_collection_from_database.php', true);
    xmlHttp.send(null);
}

function get_plant_name_from_database()
{
  var xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function()
    {

        if(xmlHttp.readyState == 4)
        {
            var plant_name_string = xmlHttp.responseText;
            plant_name_list = eval ("({'data_ii':" + plant_name_string  + "})");
        }
    }

    xmlHttp.open("GET", 'get_plant_name_from_database.php', true);
    xmlHttp.send(null);
}


function get_user_info_from_database()
{
  var xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function()
    {

        if(xmlHttp.readyState == 4)
        {
            var user_labels_string = xmlHttp.responseText;
            user_info = eval ("({'data_ii':" + user_labels_string  + "})");
        }
    }

    xmlHttp.open("GET", 'get_user_info_from_database.php', true);
    xmlHttp.send(null);
}

function load_function()
{
	// Load plant collection and associated plant info from database
	get_collection_from_database();
  get_plant_name_from_database();
  get_user_info_from_database();
}

function viewPlant(plant_id) 
{
	oldHtml = document.getElementById('largestContainer').innerHTML;
    plantInfoArray = find_plant_in_collection(plant_id);

    plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
    plantPicture = "<img class='rounded-corners' src=" + plantInfoArray[19] + ">";

    plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[5] + "</dd>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
    plantSpacing = "<dt> Spacing </dt>" + "<dd>" + plantInfoArray[13] + "</dd>";
    plantFeed = "<dt> Feed </dt>" + "<dd>" + plantInfoArray[14] + "</dd>";
    plantWater = "<dt> Water </dt>" + "<dd>" + plantInfoArray[17] + "</dd>";
    plantLight = "<dt> Preferred Light </dt>" + "<dd>" + plantInfoArray[18] + "</dd>";

    plantDescription = "<table align='center'> <tr> <td>" + plantPicture + "</td> <td><dl class='dl-horizontal' style='float:right'>"+ plantName + plantInfo + plantWaterDate +plantSpacing + plantFeed +plantWater + plantLight + "</dl></td></table>";
    document.getElementById('largestContainer').innerHTML = "<br><br><br><br><br><br><br><br>" + plantDescription+ "<br> <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button>";
}

function editPlant(plant_id, avg_days) 
{
  oldHtml = document.getElementById('largestContainer').innerHTML;
    plantInfoArray = find_plant_in_collection(plant_id);

    plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
    plantPicture = "<img class='rounded-corners' src=" + plantInfoArray[19] + ">";

    plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[5] + " <button class='btn btn-small' type='button' onclick='toggle(&quot;other_info&quot;)'>edit</button></dd><div id='other_info' style='display: none;'><form method='POST' name='editInfo' action='editOtherInfo.php'>New Info:<input type='textbox' name='other_info'><input type='hidden' name='collection_plant_id' value='" + plantInfoArray[22] + "'><input type='submit' value='change'></form></div>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
    plantWater = "<dt> Water Frequency </dt>" + "<dd>Every " + avg_days + " days</dd>";

    plantDescription = "<table align='center'> <tr> <td>" + plantPicture + "</td> <td><dl class='dl-horizontal' style='float:right'>"+ plantName + plantInfo + plantWaterDate +plantWater +"</dl></td></table>";
    document.getElementById('largestContainer').innerHTML = "<br><br><br><br><br><br><br><br>" + plantDescription+ "<br> <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button><br><br><form action='delete_plant.php' method='post'><button class='btn btn-small' type='submit' onclick=\"return confirm('Do you really want to delete the plant from your collection?');\" name='collection_plant_id' value='"+ plantInfoArray[22] +"'>Delete Plant</button></form><br><br><form action='update_water_info.php' method='post'><button class='btn btn-small' type='submit' name='delta_id' value='1'>Add a day</button><input type='hidden' name='next_water_date' value='"+ plantInfoArray[3] +"'><input type='hidden' name='collection_plant_id' value='"+ plantInfoArray[22] +"'></form><form action='update_water_info.php' method='post'><button class='btn btn-small' type='submit' name='delta_id' value='0'>Subtract a day</button><input type='hidden' name='next_water_date' value='"+ plantInfoArray[3] +"'><input type='hidden' name='collection_plant_id' value='"+ plantInfoArray[22] +"'></form>";
}

function goHome()
{
	document.getElementById('largestContainer').innerHTML = oldHtml;
}

function find_plant_in_collection(plant_id)
{
    // alert(collection_list.data_ii[1].plant_id);
    var plantArray = new Array();
    for(var plant_ii = 0; plant_ii < collection_list.data_ii.length; plant_ii++)
    {
        if(plant_id == collection_list.data_ii[plant_ii].plant_id)
        {
            plantArray.push(collection_list.data_ii[plant_ii].user_id); //0
            plantArray.push(collection_list.data_ii[plant_ii].plant_id); //1
            plantArray.push(collection_list.data_ii[plant_ii].last_water_date); //2
            plantArray.push(collection_list.data_ii[plant_ii].next_water_date); //3
            plantArray.push(collection_list.data_ii[plant_ii].pot_size); //4
            plantArray.push(collection_list.data_ii[plant_ii].other_info); //5
            plantArray.push(collection_list.data_ii[plant_ii].common_name); //6
            plantArray.push(collection_list.data_ii[plant_ii].latin_name); //7
            plantArray.push(collection_list.data_ii[plant_ii].features); //8
            plantArray.push(collection_list.data_ii[plant_ii].bloom_color); //9
            plantArray.push(collection_list.data_ii[plant_ii].blooms); //10
            plantArray.push(collection_list.data_ii[plant_ii].hardiness); //11
            plantArray.push(collection_list.data_ii[plant_ii].heights); //12
            plantArray.push(collection_list.data_ii[plant_ii].spacing); //13
            plantArray.push(collection_list.data_ii[plant_ii].feed); //14
            plantArray.push(collection_list.data_ii[plant_ii].tips); //15
            plantArray.push(collection_list.data_ii[plant_ii].habit); //16
            plantArray.push(collection_list.data_ii[plant_ii].water); //17
            plantArray.push(collection_list.data_ii[plant_ii].preferred_light); //18
            plantArray.push(collection_list.data_ii[plant_ii].image); //19
            plantArray.push(collection_list.data_ii[plant_ii].avg_days); //20
            plantArray.push(collection_list.data_ii[plant_ii].plant_id); //21
            plantArray.push(collection_list.data_ii[plant_ii].collection_plant_id); //22
        }
    }
    return plantArray;
}


function getXMLHttp()
{
  var xmlHttp
  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}

function msg_from_ajax(message)
{
    document.getElementById('test').innerHTML = message;
}

function toggle(showHideDiv){
  var ele = document.getElementById(showHideDiv);
  if(ele.style.display == "block") {
        ele.style.display = "none";

    }
  else {
    ele.style.display = "block";
  }
}

function validateForm()
{
var x=document.forms["addPlant"]["other_info"].value;
var radioObj = document.addPlant.pot_size;
var y = 0;
for(var i=0; i<radioObj.length; i++) {
    if( radioObj[i].checked ) {
        y = 1; 
    }
}

if (x==null || x=="" || y ==0)
  {
  alert("All fields must be filled out");
  return false;
  }
}

function showReminders()
{

  oldHtml = document.getElementById('largestContainer').innerHTML;
  header = "<h3>Upcoming Plant Watering Reminders</h3>";
  plantWaterTable = "<table align='center'>";
 for(var ii = 0; ii < collection_list.data_ii.length; ii++)
   {
      plantPicture = "<tr> <td> <img class='img-rounded' src=" + collection_list.data_ii[ii][21] + "><br><br>";
      plantWaterTable += plantPicture;
      plantWaterTable += "</td> <td><dl class='dl-horizontal' style='float:right'>";
      plantName = "<dt> Plant Name </dt>" + "<dd>" + collection_list.data_ii[ii][8] + "</dd>";
      plantDesc = "<dt> Plant Description </dt>" + "<dd>" + collection_list.data_ii[ii][5] + "</dd>";
      plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + collection_list.data_ii[ii][3] + "</dd>";
      plantWaterTable += plantName + plantDesc + plantWaterDate + "</dl></td>";
   }

 plantWaterTable += "</table>";

  // formthing = "<form method='POST' name='addPlant' onsubmit='return validateForm()' action=''>

  //         Size of plant pot<br>
  //                 Small: <input type='radio' id='large pot' value='large' name='pot_size'><br>
  //                   Medium: <input type='radio' id='medium pot' value='medium' name='pot_size'><br>
  //                   Large: <input type='radio' id='small pot' value ='small' name='pot_size'><br>
  //                   Extra Info (Required) : <input type='textbox' name='other_info'>
  //                   <br><br> <button class='btn btn-small' type='submit'  name='collection_plant_id' value='nothing'>Email me these reminders</button>
  //                   <input type='submit' value='add'>
  //              </form>";
 emailWateringFormButton= "<form action='email_reminders.php' onsubmit='return checkWaterReminderForm();' method='post' name='emailWateringForm'>Enter your email below to have these reminders sent to you! <br>Email (Required) : <input type='textbox' name='email'><br><button class='btn btn-small' type='submit' name='reminderSubmit' value='nothing' >Send Reminders</button></form>";

  document.getElementById('largestContainer').innerHTML = "<br><br>" + header + plantWaterTable + "<br><br>" + emailWateringFormButton + "<button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button><br>";
}

function checkWaterReminderForm()
{
  // alert('in check water function');
  var x=document.forms["emailWateringForm"]["email"].value;

  if (x==null || x=="")
  {
  alert("Email field must be filled out");
  return false;
  }
  else
  {
    alert('Email will be sent to ' + document.forms["emailWateringForm"]["email"].value);
  }
}

function editNotifications()
{
  // alert('inside edit notifications function');
  oldHtml = document.getElementById('largestContainer').innerHTML;

  var currentNotificationTime = user_info.data_ii[0][7] + ":" + user_info.data_ii[0][8] + user_info.data_ii[0][9];

notificationTimeForm = "<form method='POST' name='changeTime' action='editNotifications.php' method='POST'><h3>Your Current Notification Time is " + currentNotificationTime + "</h3><h4>Change your Notification Time</h4>Notification Time<br>Hour:<select name = 'hour' style='width: 60px'><option value = 1>1</option><option value = 2>2</option><option value = 3>3</option> <option value = 4>4</option> <option value = 5>5</option> <option value = 6>6</option> <option value = 7>7</option> <option value = 8>8</option> <option value = 9>9</option> <option value = 10>10</option> <option value = 11>11</option> <option value = 12>12</option> </select> Min:<select name = 'min' style='width: 60px'> <option value = 00>00</option> <option value = 15>15</option> <option value = 30>30</option> <option value = 45>45</option> </select> AM/PM:<select name = 'AMPM' style='width: 60px'> <option value = 'AM'>AM</option> <option value = 'PM'>PM</option> </select> <br> <input class='btn btn-small' type='submit' name='submitType' value='Update Time' /></form>"; 

var currentNotificationSetting;
if (user_info.data_ii[0][6] == "Y")
  currentNotificationSetting = "You are currently recieving email notifications";
else 
  currentNotificationSetting = "You are not recieving email notifications";

toggleNotification = "<form method='POST' name='toggleOnOff' action='editNotifications.php' method='POST'><h3>"+ currentNotificationSetting +"</h3><h4>Turn Notifications On/Off</h4>Notifications On: <input type='radio' id='on' value='Y' name='notificationSetting'><br>Notifications Off: <input type='radio' id='off pot' value='N' name='notificationSetting'><br><input type='submit' name='submitType' value='Update Setting' class='btn btn-small'/></form>"; 
document.getElementById('largestContainer').innerHTML = "<br><br><br><br><br><br>" + notificationTimeForm + toggleNotification+ "<button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button><br>";
}

