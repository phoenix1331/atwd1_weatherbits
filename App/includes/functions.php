<?php

function getData($url){

	//Declare empty content variable
	$contents = "";
	//Pull in XML data
	$xml = simplexml_load_file($url);
	//Go get our title
	$contents .= $xml->channel->item->title."<br><br>";
	//Get our weather data
	$contents .= $xml->channel->item->description."<br>";
	//Go get the Latitude
	$geoLat =  $xml->channel->item->xpath("geo:lat");
	$contents .=  "The Latitude is: ".$geoLat[0]."<br>";
	//Go get the Longitude
	$geoLong =  $xml->channel->item->xpath("geo:long");
	$contents .=  "The Longitude is: ".$geoLong[0];
	//Echo everything out
	echo $contents;

}


function getLatLong($url){

	//Declare empty content variable
	$contents = "";
	//Pull in XML data
	$xml = simplexml_load_file($url);
	//Go get the Latitude
	$geoLat =  $xml->channel->item->xpath("geo:lat");
	$contents .= $geoLat[0].",";
	//Go get the Longitude
	$geoLong =  $xml->channel->item->xpath("geo:long");
	$contents .=  $geoLong[0];
	//Return Lat and Long
	return $contents;

}

/*
*@This function is used to reverse geocode
*using Google map api to return the address
*of the distillery. 
*@This function uses the function getLatLong
*to get the Latitude and Longitude.
*
*/

function getAddress($url){
	
	//Get lat long using function
	$latLong = getLatLong($url);
	//Reverse geocode the lat long to get json data
	$json = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=$latLong&sensor=true");
	//Decode json data
	$data = json_decode($json);
	//Check returned data
	//var_dump($obj);
	//Create Address from data
	$address = "";
	$address .= $data->results[0]->address_components[0]->long_name.' ';
	$address .= $data->results[0]->address_components[1]->long_name.' ';
	$address .= $data->results[0]->address_components[2]->long_name.' ';
	$address .= $data->results[0]->address_components[3]->long_name;
	//Echo address
	echo $address;

}

?>