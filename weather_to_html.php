<?php 

require ("commonlib.php"); 
require("wdllib.php"); 

//main 
$site = "http://www.alvestonweather.co.uk/";
$site = $_REQUEST["site"]; 

$rawdatafile = $site . "/clientraw.txt"; 
//$csv = uwe_get_file($rawdatafile); //Use when on milly server
$csv = file_get_contents($rawdatafile); 
$data = explode(' ',$csv); 
$sumary = str_replace("_"," ",$data[SUMMARY]);
$wind = degree_to_compass_point($data[WINDDIRECTION]);

//Make chart
$extrarawdatafile = $site . "/clientrawextra.txt"; 
$extracsv = file_get_contents($extrarawdatafile); 
$extradata = explode(' ',$extracsv); 
$googleuri = wdl_wind_chart($extradata);

function getLink($sitelink){
$extrarawdatafile = $sitelink; 
$extracsv = file_get_contents($extrarawdatafile); 
$extradata = explode(' ',$extracsv); 
$googleuri = wdl_wind_chart($extradata);
return $googleuri;
}

$alvestongoogleuri = getLink("http://www.martynhicks.co.uk/weather/clientrawextra.txt");
$horfieldgoogleuri = getLink("http://www.alvestonweather.co.uk/clientrawextra.txt"); 
?>

<!DOCTYPE html>
<html>

<head>
<title><?php echo $data[STATION]; ?></title>
</head>
<body>

<p><?php echo "Your chosen weather station is: $site <br> $sumary Wind {$data[WINDSPEED]} knots from $wind. Barometric Pressure is {$data[BAROMETRIC]}. Temperature {$data[TEMPERATURE]} &#0176;C. "; ?></p>

<?php print "<img src=\"$googleuri\" />"; ?>

<br><br>
<h1>Horfield</h1>
<?php print "<img src=\"$horfieldgoogleuri\" />"; ?>
<h1>Alveston</h1>
<?php print "<img src=\"$alvestongoogleuri\" />"; ?>
<br><br>

<form action="" method="post"  >
<input type="text" name="site" placeholder="Enter URL here" >
<input type="submit" name="submit" value="submit">
</form>

</body>
</html>