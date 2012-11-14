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

    plantName = "<dt> Plant Name </dt>" + "<dd>" + plantInfoArray[6] + "</dd>";
    plantPicture = "<img src=" + plantInfoArray[19] + ">";

    plantInfo = "<dt> Plant Information </dt>" + "<dd>" + plantInfoArray[5] + "</dd>";
    plantWaterDate = "<dt> Next Water Date </dt>" + "<dd>" + plantInfoArray[3] + "</dd>";
    plantSpacing = "<dt> Spacing </dt>" + "<dd>" + plantInfoArray[13] + "</dd>";
    plantFeed = "<dt> Feed </dt>" + "<dd>" + plantInfoArray[14] + "</dd>";
    plantWater = "<dt> Water </dt>" + "<dd>" + plantInfoArray[17] + "</dd>";
    plantLight = "<dt> Preferred Light </dt>" + "<dd>" + plantInfoArray[18] + "</dd>";

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