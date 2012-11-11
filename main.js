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
	document.getElementById('largestContainer').innerHTML = "<br><br><br><br><br><br><br><br><br><br><br>  <button class='btn btn-small' onclick='goHome()' type='button'>Back to Collection</button>";

	// alert('plant_id is' + plant_id);
}

function goHome()
{
	document.getElementById('largestContainer').innerHTML = oldHtml;
}