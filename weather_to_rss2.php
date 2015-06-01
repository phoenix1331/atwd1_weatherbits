<?php 

require ("commonlib.php"); 
require("wdllib.php"); 

//main 
$site = $_REQUEST["site"]; 
$rawdatafile = $site . "/clientrawextra.txt"; 
$csv = uwe_get_file($rawdatafile); 
$data = explode(' ',$csv); 
$sumary = str_replace("_"," ",$data[SUMMARY]);
$wind = degree_to_compass_point($data[WINDDIRECTION]);
    
// generate the RSS  
print <<<EOT
<?xml version="1.0"?>  
<rss version="2.0"> 
  <channel> 
      <title>{$data[STATION]}</title> 
      <link>{$site}</link> 
      <item> 
         <title>Weather at {$data[TIMEHH]}:{$data[TIMEMM]}</title> 
         <description> {$sumary} . Wind {$data[WINDSPEED]} knots from {$wind}. Barometric Pressure is {$data[BAROMETRIC]}. Temperature {$data[TEMPERATURE]} &#0176;C. </description> 
      </item> 
  </channel> 
 </rss> 
EOT;

//var_dump($data);

?>