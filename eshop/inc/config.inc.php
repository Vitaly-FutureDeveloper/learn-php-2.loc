<?php
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "eshop");
define("ORDERS_LOG", "orders.log");

$basket = []; //Для хранения корзины пользователя
$count = 0; //Для хранения кол-ва товаров в корзине

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
    if ( !$link ){
        echo "Ошибка: "
            . mysqli_connect_errno()
            . " - "
            . mysqli_connect_error();
    }

/* Инициализация или Взятие корзины из куки */ 
basketInit();