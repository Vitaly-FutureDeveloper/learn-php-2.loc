<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
	if (!myBasket()){
		echo "<p>" . "Корзина пуста вернитексь в <a href='/eshop/catalog.php'>каталог</a>" . "</p>";
		exit;
	 }
	else
		echo "<p>" . "Вернуться в <a href='/eshop/catalog.php'>каталог</a>" . "</p>";

	$goods = myBasket();
	$i = 1;
	$sum = 0;
?>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
	foreach($goods as $item) {
	?>
	<tr>
		<td><?= "N п/п " . $i  ?></td>
		<td><?= "Название " . $item['title']  ?></td>
		<td><?= "Автор " . $item['author']  ?></td>
		<td><?= "Год издания " . $item['pubyear']  ?></td>
		<td><?= "Цена, руб. " . $item['price']  ?></td>
		<td><?= "Количество " . $item['quantity']  ?></td>
		<td><?= "<a href='delete_from_basket.php?id=" . $item['id'] ."'" . ">Удалить</a>" ?></td>
	</tr>
	<?
		$sum += $item['price'] * $item['quantity'];
		$i++;
	}
	echo "<p>Общее кол-во товаром в корзине: " . $i . " на сумму: " . $sum . "</p>";
?>
</table>

<p>Всего товаров в корзине на сумму:<?= $sum ?> руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>







