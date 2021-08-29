<?php
	//Init Variables
	$title = "View Products";

	//Header
	require 'header.php';

	//Perform select query on data in t_products
	$sql = 'SELECT * FROM `t_products`';
	$query_data = mysqli_query($conn, $sql) or DIE('Error - Select Query Failed');

	//Store data in local array
	$array_products = array();
	while($row = mysqli_fetch_array($query_data)){
		//Remove unnecasary data from row
		array_pop($row);
		//push
		array_push($array_products, $row);
	}

	//Populate number fields with 0s
	$array_numberfields = array_fill(0, sizeof($array_products), 0);

	//Calculate total
	if(ISSET($_POST['button_calcorder'])) {
		if(ISSET($_POST['number_field'])) {
			$array_numberfields = $_POST['number_field'];
			$checkout_total = 0;
			//Loop through and calc total
			for($i = 0; $i < sizeof($array_numberfields); $i ++) {
				$checkout_total += $array_numberfields[$i]*$array_products[$i][2];
			}
		}
	}

	//Send order data to database
	if(ISSET($_POST['button_confirmorder'])) {
		if(ISSET($_POST['hidden_numberfields'])) {
			$array_hiddennumberfields = explode(',', $_POST['hidden_numberfields']);
			//Loop through all order items
			for($i = 0; $i < sizeof($array_products); $i ++) {
				//Perform update query, saving the order sales data
				$db_id = $i + 1;
				$new_value = $array_products[$i][3] + $array_hiddennumberfields[$i];
				$sql = "UPDATE `t_products` SET `product_sales` = '$new_value' WHERE `t_products`.`product_id` = '$db_id'";
				mysqli_query($conn, $sql) or DIE('Error - Update Query Failed');
			}

		}
	}
?>
<html>
<?php
	//Check if order was confirmed last refresh
	if(ISSET($_POST['button_confirmorder'])) {
?>
	<div class="div-content">
		<h1>
			Order Confirmed
		</h1>

		<!--Return to the previous screen-->
		<button onClick="window.location.href=window.location.href">Continue</button>
	</div>
<?php
	}else{
		//Check if total was calculated on last refresh
		if(ISSET($checkout_total)) {
?>
			<div class="div-content">
				<h1>
					Order Summary
				</h1>

				<!--List of order contents-->
				<table>
					<tr>
						<td>
							<?php echo('Your total is $' . number_format($checkout_total, 2)); ?>
							<hr>
						</td>
					</tr>
<?php
				for($i = 0; $i < sizeof($array_numberfields); $i ++) {
					//Check current item has quant greater than 0
					if($array_numberfields[$i] > 0) {
?>
					<tr>
						<td>
							<?php echo($array_products[$i][1] . ' x' . $array_numberfields[$i]);?>
						</td>
					</tr>
<?php
					}
				}
?>
				</table>


				<!--Return to the previous screen-->
				<button onClick="window.location.href=window.location.href">Go Back</button>

				<!--Submit order to database-->
				<form method="POST" action="checkout.php">
					<input type="hidden" name="hidden_numberfields" value="<?php echo(implode(',', $array_numberfields)); ?>">
					<input type="submit" name="button_confirmorder" value="Confirm Order">
				</form>
			</div>
<?php
		}else{
?>

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
								Product
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
									<input size="3" type="number" name="<?php echo('number_field[' . strval($i) . ']'); ?>" min="0" max="100" value="<?php echo($array_numberfields[$i]); ?>">
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
				<input type=submit name="button_calcorder" value="Calculate Total">
			</form>
		</div>
<?php
		}
	}
?>
</html>
<?php

	//Footer
	require 'footer.php';

?>
