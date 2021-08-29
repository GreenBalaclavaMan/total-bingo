<?php
	//Init Variables
	$title = "View Products";

	//Header
	require 'header.php';

	//Perform select query on data in t_products
	$sql = 'SELECT * FROM `t_products`';
	$query_data = mysqli_query($conn, $sql) or DIE('Bad Select Query');

	//Store data in local array
	$array_products = array();
	while($row = mysqli_fetch_array($query_data)){
		array_push($array_products, $row);
	}

?>
<html>
	<div class="div-content">
		<h1>
			View products
		</h1>

		<p>
			Here is a list of all products, and their associated sales statistics.
		</p>

<?php
	//Check if array_products exists
	if(ISSET($array_products)) {
?>
		<!--Product data-->
		<table>
			<tr>
				<th>
					Name
				</th>
				<th>
					Cost
				</th>
				<th>
					Total # Sold
				</th>
			</tr>
<?php
		//Loop through array_product
		for($i=0; $i < sizeof($array_products); $i ++) {
?>
			<tr>
				<td>
					<?php echo($array_products[$i][1]); ?>
				</td>
				<td>
					<?php echo('$' . number_format($array_products[$i][2], 2)); ?>
				</td>
				<td>
					<?php echo($array_products[$i][3]); ?>
				</dt>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</html>
<?php

	//Footer
	require 'footer.php';

?>
