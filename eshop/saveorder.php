<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$name = clearStr($_POST['name']);
		$email = clearStr($_POST['email']);
		$phone = clearStr($_POST['phone']);
		$address = clearStr($_POST['address']);
		
		$oid = $basket["orderid"];
		$DTime = date("Y-n-d" . ' ——> ' . "H:i:s");
		$datetime = time();

		$order = $name . " | " . $email . " | " . $phone . " | " . $address . " | " . $oid . " | " . $datetime;

		ordersLog ($order);
		saveOrder ($datetime);
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>