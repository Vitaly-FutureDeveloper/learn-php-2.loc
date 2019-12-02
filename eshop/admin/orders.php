<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

	$orders = getOrders ();
	if(!$orders) {
		echo "<p>Заказов нет</p>";
		exit;
	}
?>

<pre>
<? //var_dump($orders); ?>
</pre>

<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
//Начало массива вывода
foreach ($orders as $order) {
	$dt = date("d-m-Y H:i", $order["orderid"]);
?>
<hr>
<h2>Заказ номер: <?= $order['orderid'] ?> </h2>
<p><b>Заказчик</b>: <?= $order['name'] ?> </p>
<p><b>Email</b>: <?= $order['email'] ?> </p>
<p><b>Телефон</b>: <?= $order['phone'] ?> </p>
<p><b>Адрес доставки</b>: <?= $order['address'] ?> </p>
<p><b>Дата размещения заказа</b>: <?= $dt ?> </p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
<?php
	foreach($order['goods'] as $item) {
	?>
	<tr>
		<td><?= "N п/п " . $i  ?></td>
		<td><?= "Название " . $item['title']  ?></td>
		<td><?= "Автор " . $item['author']  ?></td>
		<td><?= "Год издания " . $item['pubyear']  ?></td>
		<td><?= "Цена, руб. " . $item['price']  ?></td>
		<td><?= "Количество " . $item['quantity']  ?></td>
	</tr>
	<?
		$sum += $item['price'] * $item['quantity'];
		$i++;
	}
	echo "<p>Общее кол-во товаром в корзине: " . $i . " на сумму: " . $sum . "</p>";
?>

</table>
<p>Всего товаров в заказе на сумму:<?= $sum ?> руб.</p>
<?
// Формирование ответа заказа по Ордер id

//
}
//Конец массива вывода
?>
</body>
</html>