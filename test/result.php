<?php
$result = 0; //ВАР для суммы ответов
if (isset($_SESSION['test'])) { //Зачитываем ответы из ini файла в массив
	$answer = parse_ini_file("answers.ini");
	// Проходим по ответам и смотрим есть ли правильные
	foreach ($_SESSION['test'] as $value) {
		if (array_key_exists($value, $answer))
		//суммируем правильные ответы
			$result += (int) $answer[$value];
	}
	//Очищаем данные сессии
	session_destroy();
}
?>

<table width="100%">
	<tr>
		<td align="left">
			<p>Ваш результат: <?= $result ?> из 30</p>
		</td>
	</tr>
</table>