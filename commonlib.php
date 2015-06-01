<?php 
function uwe_get_file($uri) { 
 // get a file via UWE proxy and stop caching 
  
    $context = stream_context_create( 
    array('http'=> 
        array('proxy'=>'localhost:8080', 
              'header'=>'Cache-Control: no-cache' 
             ) 
     ));   
    $contents = file_get_contents($uri,false,$context); 
    return $contents; 
}; 
?>