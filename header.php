<!DOCTYPE html PUBLIC>
<?php

	//Gain DB Conn
	require_once 'scripts/dbc.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
     <head>
     	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0">

     	<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">

          <!--Page Title-->
          <title>
               <?php echo "Total Bingo - " . $title; ?>
          </title>
     </head>

     <body>

          <!-- start of main page content. -->
          <div class="div-main">

               <!--Banner-->
               <div class="div-header">
				<!--Logo-->
				<div class="header-logo">
	                    <a href="index.php">
	                         Goto Main Menu <!--<img class="header-logo" src="images/logo.png" alt="Knot Logo">-->
	                    </a>
				</div>
			</div>

</html>
