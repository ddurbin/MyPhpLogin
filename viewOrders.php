<html>
	<head>
		<title>Bob's Auto Parts - Customer Orders</title>
	</head>
	<style>
		table, th, td {
    		border: 1px solid black;
		}
	</style>
	<body>
		<h2>Bob's Auto Parts - Customer Orders</h2>
		<div>
			<table>
				<tr>
					<td>
						<a href="/orderForm.html">Place Order</a>
					</td>
				</tr>
			</table>
		</div>
		<?php
			include_once("config.php");

			$fp = getFileForRead();
			if(!$fp) {
				echo "<p><strong>No orders pending.</strong></p></html>";
				exit;
			}
			if(isFileEmpty()) {
				echo "<p><strong>No Orders at this time</strong></p></html>";
				exit;

			}else {
				echo "<table><tr><th>#</th><th>Date</th><th>Tires</th><th>Quarts of Oil</th><th>Spark Plugs</th><th>Address</th><th>Sub-total</th><th>Tax</th><th>Total</th></tr>";
			$i = 0;
			$order = fgets($fp, 999);
			while(!feof($fp)) {
				$i++;
				$orderArr = explode("\t", $order);
				if($orderArr)
				echo "<tr>";
				echo "<td>$i</td>";
				foreach($orderArr as $value) {
					echo "<td>$value</td>";
				}
				echo "</tr>";
				$order = fgets($fp, 999);
			}

			echo "</table>";
			}
			
		?>
	</body>	
</html>