<?php
	//Init Variables
	$title = "Main";

	//Header
	require 'header.php';

?>
<html>
	<div class="div-content">
		<h1>
			Welcome
		</h1>
		<p>
			This is the landing page. The order calculation tool and sales records can be accessed using the buttons below.
		</p>
	</div>
	<div class="div-content">
		<table>
			<tr>
				<th>
					Product Sales Records
				</th>
				<th>
					Order Calculator Tool
				</th>
			</tr>
			<tr>
				<td>
					<button onClick="location.href='viewproducts.php'">View</button>
				</td>
				<td>
					<button onClick="location.href='checkout.php'">View</button>
				</td>
			</tr>
		</table>
	</div>
</html>
<?php

	//Footer
	require 'footer.php';

?>
