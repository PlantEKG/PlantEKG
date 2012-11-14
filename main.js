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


function load_function()
{
	// Load plant collection and associated plant info from database
	get_collection_from_database();
}

function viewPlant(plant_id) 
{
	oldHtml = document.getElementById('largestContainer').innerHTML;
    plantInfoArray = find_plant_in_collection(plant_id);

    plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[0] + "</dd>";
    plantPicture = "<img src=" + plantInfoArray[1] + ">";

    plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[2] + "</dd>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
    plantSpacing = "<dt> Spacing </dt>" + "<dd>" + plantInfoArray[4] + "</dd>";
    plantFeed = "<dt> Feed </dt>" + "<dd>" + plantInfoArray[5] + "</dd>";
    plantWater = "<dt> Water </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
    plantLight = "<dt> Preferred Light </dt>" + "<dd>" + plantInfoArray[7] + "</dd>";

    plantDescription = "<table align='center'> <tr> <td>" + plantPicture + "</td> <td><dl class='dl-horizontal' style='float:right'>"+ plantName + plantInfo + plantWaterDate +plantSpacing + plantFeed +plantWater + plantLight + "</dl></td></table>";
    document.getElementById('largestContainer').innerHTML = "<br><br><br><br>" + plantDescription+ "<br> <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button>";

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
            plantArray.push(collection_list.data_ii[plant_ii].plant_name);
            plantArray.push(collection_list.data_ii[plant_ii].plant_url);
            plantArray.push(collection_list.data_ii[plant_ii].other_info);
            plantArray.push(collection_list.data_ii[plant_ii].next_water_date);
            plantArray.push(collection_list.data_ii[plant_ii].spacing);
            plantArray.push(collection_list.data_ii[plant_ii].feed);
            plantArray.push(collection_list.data_ii[plant_ii].water);
            plantArray.push(collection_list.data_ii[plant_ii].preferred_light);
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