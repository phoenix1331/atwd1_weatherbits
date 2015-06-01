<?php 
// define the positions of commonly used values in the array  
define ('WINDSPEED',1); 
define ('WINDDIRECTION',3); 
define('TEMPERATURE',4); 
define('TIMEHH',29); 
define ('TIMEMM',30); 
define('STATION',32); 
define('SUMMARY',49); 
define('BAROMETRIC',131); 


function degree_to_compass_point($d){
   $dp = $d + 11.25;
   $dp = $dp % 360;
   $dp = floor($dp / 22.5) ;
   $points = array("N","NNE","NE","ENE","E","ESE","SE" ,"SSE" ,"S", "SSW","SW","WSW","W", "WNW","NW","NNW","N");
   $dir = $points[$dp];
   return $dir;
 };
 
 function wdl_wind_chart($data) {
//convert the wdl wind history to a google chart 
//data values go from oldest to newest
  $chartType= "lc";
  $chartSize ="500x300";
  $points = join(array_slice($data,1,20),",");  //  these are the 20 latest wind speeds
  $title = "Wind Speed in the last 20 Hours";
  $uri =  "http://chart.apis.google.com/chart?cht=". $chartType . "&chs=". $chartSize . "&chd=t:" . $points . "&chtt=" . $title ;
  return $uri ;
};
?>