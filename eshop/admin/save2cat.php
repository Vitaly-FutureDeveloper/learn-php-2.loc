<?php
	// подключение библиотек
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

	$title = clearStr($_POST["title"]);
	$author = clearStr($_POST["author"]);
	$pubyear = clearInt($_POST["pubyear"]);
	$price = clearStr($_POST["price"]);

	if ( !addItemToCatalog ($title, $author, $pubyear, $price) ){ 
		echo "Произошла ошибка при добавлении товара в каталог "
		. mysqli_errno($link)
		. " - "
		. mysqli_error($link);
		}
	else {
		header("Location: http://learn-php-2.loc/eshop/admin/add2cat.php");
		exit;
}

