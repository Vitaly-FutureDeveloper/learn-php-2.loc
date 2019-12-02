<?php
require_once "lib.inc.php";
$time = date (" Y-m-d в G:i:s ");

/* Основные настройки */
define ("DB_HOST", "localhost");
const DB_LOGIN = "root";
define ("DB_PASSWORD", "");
define ("DB_NAME", "gbook");

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
errs_reporting ($link);
/* Основные настройки */

/* Сохранение записи в БД */
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Форма отправлена";
    $name = mysqli_real_escape_string ($link ,trim(strip_tags($_POST['name'])));

    $email = trim(strip_tags($_POST['email']));
    $msg = strip_tags($_POST['msg']); //Сообщение

    echo "$name " . "$email " . "$msg ";

    $result = mysqli_query ($link, "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg') ");
    errs_reporting_result ($result, $link);
}
mysqli_close($link);
/* Сохранение записи в БД */

/* Удаление записи из БД */
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $del = (int) trim (strip_tags ($_GET['del']));
    
    $link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
        errs_reporting ($link);

        $zapros = "DELETE FROM msgs WHERE id = $del";
        $result = mysqli_query($link, $zapros);
        errs_reporting_result ($result, $link);

    mysqli_close($link);
    echo '<h1>' . $del . '</h1>';
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
errs_reporting ($link);

$zapros = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC";
$result = mysqli_query($link, $zapros);
//$otvet = mysqli_real_escape_string ($link, $result);
errs_reporting_result ($result, $link);

mysqli_close($link);

$arr_result = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo "<p>Кол-во записей в гостевой книге: " . count($arr_result). "</p>";
foreach ($arr_result as $key => $value) {
//Наше сообщение из БД
    echo '<p>'  //Открыли параграф

        . '<a href="maito:' //Открыли ссыылку на мейл
        . $value['email'] //Взяли мейл из VAR
        . '">' //Выставили тег
        . $value['name'] //Между тегами <a> и </a> введено имя
        . '</a>' //Закрыли тег <a>

        . $time //Вывели время
        . ' написал <br>' 
        . $value['msg'] //Наше сообщение из БД

        . '</p>'; //Закрыли параграф
//Конец Наше сообщение из БД

//Ссылка удалить
    echo '<p align="right">'  //Открыли параграф
        . '<a href="http://mysite2.loc/index.php?id=gbook&del='
        . $value['id']
        . '">Удалить</a>'
        . '</p>';

        //echo '<h1>' . $value['id'] . '</h1>';
}

/* Вывод записей из БД */
?>