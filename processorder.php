<html>
	<head>
		<title>Bob's Auto Parts - Order Results</title>
	</head>
	<body>
		<h1>Bob's Auto Parts</h1>
		<h2>Order Results:</h2>
		<div>
			<table>
				<tr>
					<td>
						<a href="/orderForm.html">Place Order</a>
					</td>
					<td>
						<a href="/viewOrders.php">View Orders</a>
					</td>
				</tr>
			</table>
		</div>
		<?php
			include_once("config.php");

			date_default_timezone_set('America/Phoenix');
			$date = date("l jS \of F Y h:i:s A");
			echo '<p>Order Processed: ';
			echo $date;
			echo '</p>';

			//create short variable names
			$tireqty = $_POST["tireqty"];
			$oilqty = $_POST["oilqty"];
			$sparkqty = $_POST["sparkqty"];
			$address = $_POST["address"];
			$taxRate = 0.10;
			$subtotal = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;
			$tax = $subtotal * $taxRate;
			$totalAmount = $subtotal * (1 + $taxRate);

			echo '<h3>Your Order is as Follows:</h3>';
			echo $tireqty.' tires<br>';
			echo $oilqty.' quarts of oil<br>';
			echo $sparkqty.' spark plugs<br>';
			echo "<hr width='15%' align='left'>";
			echo "<p>Subtotal: $".number_format($subtotal, 2)."</p>";
			echo "<p>Tax: $".number_format($tax, 2)."</p>";
			echo "<p>Total Amount owed: $".number_format($totalAmount, 2)."</p>";

			//save order
			$fp = getFileForWrite();
			if(!$fp) {
				echo "<p><strong>Your order could not be processed at this time. Please try again later</strong></p></html>";
				exit;
			}

			//write the order to the file in the following form:
			//date  tireqty  oilqty  sparkqty  address  subtotal  tax  total 
			$orderString = "$date\t$tireqty\t$oilqty\t$sparkqty\t$address\t$subtotal\t$tax\t$totalAmount\n";
			fwrite($fp, $orderString, strlen($orderString));
			fclose($fp);
			echo "<p>Order Written!</p>";
		?>
	</body>
</html>