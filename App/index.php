<?php require_once('includes/class.php'); ?>
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
		
		<script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=" type="text/javascript">
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
		
		<?php
		
			$find2 = new data("http://weather.yahooapis.com/forecastrss?w=26836392");
			echo $find2->getData();
		
		?>
	
		
		
	</div> <!--End wrap -->
    </body>
</html>