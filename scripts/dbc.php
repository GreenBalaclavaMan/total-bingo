<?php
     $conn = mysqli_connect('localhost','root','','db_totalbingo');//or DIE('No Connection');
	// Check connection
	if (!$conn) {
	  die("Error - " . mysqli_connect_error());
	}
?>
