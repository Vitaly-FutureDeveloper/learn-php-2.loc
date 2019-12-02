<?
function errs_reporting ($link) { //Функция проверки на ошибки при соединении
    if ( !$link ){
        echo '<h1> Ошибка соединения: '
            . mysqli_connect_errno()
            . ' : '
            . mysqli_connect_error();
        echo '</h1>';
    }
}
function errs_reporting_result ($result, $link) { //Функция проверки на ошибки при вводе
    if ( !$result ){
        echo '<h1> Ошибка результата в БД: '
            . mysqli_errno($link)
            . ' : '
            . mysqli_error($link);
        echo '</h1>';
    }
}