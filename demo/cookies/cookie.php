<?php
	setcookie("userName", 'John');

	//echo $_COOKIE["userName"];

	$user = [
		'name' => 'John',
		'login' => 'root',
		'password' => '1234'
	];

	$str = base64_encode(serialize($user));
	echo $str . "<br>";
	$str_encode = unserialize(base64_decode($str));
	print_r($str_encode);
?>