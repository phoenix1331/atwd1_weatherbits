<?php
$search = '';
  $search = $_REQUEST['search'];
  $csv = file("wdlsites.csv");  
  foreach ($csv as $site) {
      list($location,$uri,$lat,$long) = explode(",", $site);
      if (strpos($location,$search) !== FALSE){  // returns 0 ... n - care needed since 0 is false hence magic
	    echo "<a href='$uri' target='_blank'>$location</a> <a href='https://maps.google.co.uk/maps?q=$lat,$long' target='_blank'>Map</a><br>";
      }
   }

?>
<br>
<br>
<br>
<br>
<form action="" method="post"  >
<input type="text" name="search" placeholder="Enter search here" >
<input type="submit" name="submit" value="submit">
</form>