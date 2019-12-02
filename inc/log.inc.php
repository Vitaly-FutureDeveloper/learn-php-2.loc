<?
define ('PATH_LOG', 'path.log'); //Имя файла журнала

$dt = date("Y.F.j" . ' время: ' . "H:i:s");
$page = $_SERVER ['REQUEST_URI']; //Где мы находимся сейчас (на какую стр. перешли)
$ref = $_SERVER['HTTP_REFERER']; //Покажет с какой стр. мы перешли сюда
$path = $dt . ' | ' . $ref . ' ——> ' . $page;

if ( !is_file("log/".PATH_LOG) ) { //Проверка есть ли файл
    if ( !is_dir("log/") ) //Проверка есть ли дирректория
        mkdir("log/"); //Создаём дирректорию
    //Создаём файл
    $file = fopen("log/".PATH_LOG, "w+") or die ("Не Создаётся");
    fwrite($file, "Логи" . PHP_EOL);
    fclose($file);
}
$file = fopen("log/".PATH_LOG, 'a+') or die ("Не открывается");
    fputs ($file, $path . PHP_EOL);
fclose($file);


