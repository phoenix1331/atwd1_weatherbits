<?php
  /*$search = '';
  $search = $_REQUEST['search'];
  $csv = file("wdlsites.csv");  
  foreach ($csv as $site) {
      list($location,$uri,$lat,$long) = explode(",", $site);
      if (strpos($location,$search) !== FALSE){  // returns 0 ... n - care needed since 0 is false hence magic
	    echo "<a href='$uri' target='_blank'>$location</a> <a href='https://maps.google.co.uk/maps?q=$lat,$long' target='_blank'>Map</a><br>";
      }
   }*/
  // $file = file_get_contents("http://weather.yahooapis.com/forecastrss?w=26836392");
   //$data = array($file);
   //echo $data;
   //var_dump($data);$dom = new DOMDocument;
  // $dom = new DomDocument;
	//$dom->loadXML("http://weather.yahooapis.com/forecastrss?w=26836392");
  // $files = $file->getElementsByTagName('description');
  // echo $files;
/*$doc = new DOMDocument();
$file = file_get_contents("http://weather.yahooapis.com/forecastrss?w=26836392");
$doc->loadXML($file);



$names = $doc->getElementsByTagName("image");
$name = $names->item(0);
$named = $name->nodeValue;*/

//echo $name->$title;

//echo $name;
//var_dump($name);
//$file = file_get_contents("http://weather.yahooapis.com/forecastrss?w=26836392");
?>





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
 
getData("http://weather.yahooapis.com/forecastrss?w=26836392");

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

?>
<style type="text/css">
#wrap{
	width:50%;
}
p{
	background:#ccc;
}


</style>
<h1>Tweets from UWE</h1>
  <?php      
        //Based on code by James Mallison, see https://github.com/J7mbo/twitter-api-php
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');
        
        //header('Content-Type: text/html; charset="UTF-8"');
        
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => "23567390-ZG71V6roL3QDzM9xEbddqEhCep8XCkHGNZYiNujf9",
            'oauth_access_token_secret' => "PFG7x0BGbIwdR8YtahMZ8uJKKlBlSKPxzNf3LdZUJc5OB",
            'consumer_key' => "Z59cXcpw3xExeZXmwVaxWw",
            'consumer_secret' => "VVd2aAWLJuVU0xWbZk5mAVqJyN7o2YnDK7EXMUNb7U4"
        );
        
        /** Perform a GET request and echo the response **/
        /** Note: Set the GET field BEFORE calling buildOauth(); **/
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
		//Get lat and long from XML data
		$latLong = getLatLong("http://weather.yahooapis.com/forecastrss?w=26836392");
        $getfield = "?q=&geocode=$latLong,20km";
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $data=$twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        
        //Use this to look at the raw JSON
       // echo($data);
        
        // Read the JSON into a PHP object
        $phpdata = json_decode($data, true);
        
        // Debug - check the PHP object
        //var_dump($phpdata)
        echo "<div id='wrap'>";
        //Loop through the status updates and print out the text of each
        foreach ($phpdata["statuses"] as $status){
        	echo("<p>" . $status["text"] . "<br><em>".$status["created_at"]."</em></p>");
        }
		
		echo "</div>";
        //Uncomment line below to see if latLong is working
		//echo $latLong;
        


/*//Pull in XML data
$xml = simplexml_load_file("http://weather.yahooapis.com/forecastrss?w=26836392");
//Go get our title
echo $xml->channel->item->title."<br><br>";
//Go get the Latitude
$geoLat =  $xml->channel->item->xpath("geo:lat");
echo "The Latitude is: ".$geoLat[0]."<br>";
//Go get the Longitude
$geoLong =  $xml->channel->item->xpath("geo:long");
echo "The Longitude is: ".$geoLong[0];*/

?>





