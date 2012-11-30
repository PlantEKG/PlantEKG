onload = load_function;
var oldHtml;
var collection_list;

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


function load_function()
{
	// Load plant collection and associated plant info from database
	get_collection_from_database();
  get_plant_name_from_database();
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

function editPlant(plant_id) 
{
  oldHtml = document.getElementById('largestContainer').innerHTML;
    plantInfoArray = find_plant_in_collection(plant_id);

    plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
    plantPicture = "<img class='rounded-corners' src=" + plantInfoArray[19] + ">";

    plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[5] + " <button class='btn btn-small' type='button' onclick='toggle(&quot;other_info&quot;)'>edit</button></dd><div id='other_info' style='display: none;'><form method='POST' name='editInfo' action='editOtherInfo.php'>New Info:<input type='textbox' name='other_info'><input type='submit' value='change'></form></div>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
    plantWater = "<dt> Water Frequency </dt>" + "<dd>Every " + plantInfoArray[20] + "days</dd>";

    plantDescription = "<table align='center'> <tr> <td>" + plantPicture + "</td> <td><dl class='dl-horizontal' style='float:right'>"+ plantName + plantInfo + plantWaterDate +plantWater +"</dl></td></table>";
    document.getElementById('largestContainer').innerHTML = "<br><br><br><br><br><br><br><br>" + plantDescription+ "<br> <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button><form action='delete_plant.php' method='post'><button class='btn btn-small' type='submit' name='collection_plant_id' value='"+ plantInfoArray[22] +"'>Delete Plant</button></form>";
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
  // alert('In showReminders function');
  oldHtml = document.getElementById('largestContainer').innerHTML;
  // plantInfoArray = find_plant_in_collection(plant_id);

  // plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
  // plantPicture = "<img class='img-rounded' src=" + plantInfoArray[19] + ">";

  // plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[5] + "</dd>";
  // plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
  // plantSpacing = "<dt> Spacing </dt>" + "<dd>" + plantInfoArray[13] + "</dd>";
  // plantFeed = "<dt> Feed </dt>" + "<dd>" + plantInfoArray[14] + "</dd>";
  // plantWater = "<dt> Water </dt>" + "<dd>" + plantInfoArray[17] + "</dd>";
  // plantLight = "<dt> Preferred Light </dt>" + "<dd>" + plantInfoArray[18] + "</dd>";

  // plantDescription = "<table align='center'> <tr> <td>" + plantPicture + "</td> <td><dl class='dl-horizontal' style='float:right'>"+ plantName + plantInfo + plantWaterDate +plantSpacing + plantFeed +plantWater + plantLight + "</dl></td></table>";
  header = "<h3>Upcoming Plant Watering Reminders</h3>";
  plantWaterTable = "<table align='center'>";
 for(var ii = 0; ii < collection_list.data_ii.length; ii++)
 {
    plantPicture = "<tr> <td> <img class='img-rounded' src=" + collection_list.data_ii[ii][21] + ">";
    plantWaterTable += plantPicture;
    plantWaterTable += "</td> <td><dl class='dl-horizontal' style='float:right'>";
    plantName = "<dt> Plant Name </dt>" + "<dd>" + collection_list.data_ii[ii][8] + "</dd>";
    plantDesc = "<dt> Plant Description </dt>" + "<dd>" + collection_list.data_ii[ii][5] + "</dd>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + collection_list.data_ii[ii][3] + "</dd>";
    plantWaterTable += plantName + plantDesc + plantWaterDate + "</dl></td>";
 }

 plantWaterTable += "</table>";
  document.getElementById('largestContainer').innerHTML = "<br><br>" + header + plantWaterTable + "<br><br> <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button><br>";
}
