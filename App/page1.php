<?php require_once('includes/functions.php'); 
//Set Link
$link = "http://weather.yahooapis.com/forecastrss?w=26836392";
//Get lat and long
$latLong = getLatLong($link);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
		
		<!--Google Maps-->
		<script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=" type="text/javascript"></script>
		<script type="text/javascript">
			function initialize() {
			  if (GBrowserIsCompatible()) {
				var map = new GMap2(document.getElementById("map_canvas"));
				map.setCenter(new GLatLng(<?php echo $latLong; ?>), 13);
				var point =new GLatLng(<?php echo $latLong; ?>);
		
				var marker = new GMarker(point);
		  
				GEvent.addListener(marker, "click", function() {
					marker.openInfoWindowHtml("Here we are!");
						});
		
				map.addOverlay(marker);
			  }
			}

			</script>
    </head>
    <body onload="initialize()" onunload="GUnload()">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <div id='wrap'>
		<header></header>
		<nav>
			<ul>
				<li><a href="index.php" title="">Home</a></li>
				<li><a href="page1.php" title="">Speyside</a></li>
				<li><a href="page2.php" title="">Highlands</a></li>
				<li><a href="page3.php" title="">Page 3</a></li>
				<li><a href="page4.php" title="">Page 4</a></li>
			</ul>
		</nav>
		<h1>Glenfiddich Distillery</h1>
		<?php 
		//Get all data
		getData($link);
		?>
			
		<div id="map_canvas" style="width: 100%; height: 300px"></div>
		<h1>Tweets</h1>
		<?php      
        //Based on code by James Mallison, see https://github.com/J7mbo/twitter-api-php
        ini_set('display_errors', 1);
        require_once('includes/TwitterAPIExchange.php');
        
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
		$latLong = getLatLong($link);
		//$hashtag = urlencode("newport county");
        //$getfield = "?q=glenfiddich&count=10";
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
		
		$tweet = "<div id='tweet_wrap'>";

        //Loop through the status updates and print out the text of each
           foreach ($phpdata["statuses"] as $status){
        	$tweet .= "<div class='tweet'><img src='". $status["user"]["profile_image_url"] . "' class='profile_pic'/><h2>@" . $status["user"]["screen_name"] ." </h2><div class='tweet_text'>". $status["text"] . "<br><em>".$status["created_at"]."</em></div></div>";
        }
		
		$tweet .= "</div>";
		echo $tweet;
	
        //Uncomment line below to see if latLong is working
		//echo $latLong;
		
		?>

	<footer></footer>	
	</div> <!--End wrap -->
    </body>
</html>