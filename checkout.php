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
		//Remove unnecasary data from row
		array_pop($row);

		array_push($array_products, $row);
	}

	//Calculate total

?>
<html>
	<div class="div-content">
		<h1>
			Checkout
		</h1>

		<p>
			Calculate the total cost of an order using the form below.
		</p>

<?php
	//Check if array_products exists
	if(ISSET($array_products)) {
?>
		<!--Start checkout form-->
		<form method="POST" action="checkout.php">
			<!--List of products-->
			<table>
				<tr>
					<th>
						Name
					</th>
					<th>
						Quantity
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
						<link media="all" rel="stylesheet" href="./style.css">

						<div>
							<button type="button" onclick="this.parentNode.querySelector('[type=number]').stepDown();">
							-
							</button>

							<input type="number" name="number" min="0" max="100" value="0">

							<button type="button" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
							+
							</button>
						</div>
					</td>
				</tr>
<?php
			}
		}
?>
			</table>

			<!--Controls-->
			<input type=reset>
			<input type=submit name="button_submit" value="Checkout">

		</form>
	</div>
</html>
<?php

	//Footer
	require 'footer.php';

?>
