<?php
function addItemToCatalog ($title, $author, $pubyear, $price) {
    global $link;
    $sql = 'INSERT INTO catalog (title, author, pubyear, price)
        VALUES (?, ?, ?, ?)';

    //$stmt = mysqli_prepare($link, $sql);

    if (!$stmt = mysqli_prepare($link, $sql))
        return false;
    mysqli_stmt_bind_param($stmt, 'ssii', $title, $author, $pubyear, $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

//Фильтры (начало)
function clearStr ($arrPost) {
    return strip_tags($arrPost);
}
function clearInt ($arrPost) {
    $arrPost = (int) trim(strip_tags($arrPost));
    return $arrPost;
}
////Фильтры (конец)

function selectAllItems () {
    global $link;
    $sql = 'SELECT id, title, author, pubyear, price FROM catalog';
   // $result = mysqli_query($link, $sql);
    if (!$result = mysqli_query($link, $sql))
        return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}

function saveBasket () {
    global $basket;
    $basket = base64_encode(serialize($basket));
    setcookie('basket', $basket, 0x7FFFFFFF);
}

function basketInit () {
    global $basket, $count;

    if (!isset($_COOKIE['basket'])) {
        $basket = ['orderid' => uniqid()];
        saveBasket();
    }
    else {
        $basket = unserialize(base64_decode($_COOKIE['basket']));
        $count = count($basket) - 1;
    }
}

function add2Basket($id) {
    global $basket;
    $basket[$id] = 1;
    saveBasket();
}

function myBasket() {
    global $link, $basket;

    $goods = array_keys ($basket);
    array_shift($goods);

    if (!$goods) 
        return false;

    $ids = implode(",", $goods);
    $sql = "SELECT id, author, title, pubyear, price 
        FROM catalog WHERE id IN ($ids)";

    $result = mysqli_query($link, $sql);
    if (!$result)
        return false;

    $items = result2Array($result);
    mysqli_free_result($result);
    return $items;
}

function result2Array($data) {
    global $basket;
    $arr = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }

    return $arr;
}

function deleteItemFromBasket ($id) {
    global $basket;

    unset($basket[$id]);
    saveBasket();
}

//Формирование заказа
//Создание файла и запись в файл
function ordersLog ($order) {
    if (!is_file("../eshop/admin/" . ORDERS_LOG)){
        $file = fopen ("../eshop/admin/" . ORDERS_LOG, "w+") or die ("Ошибка создания файла");
            fputs($file, "#Тут все заказы" . PHP_EOL);
        fclose($file);
    }

    $file = fopen ("../eshop/admin/" . ORDERS_LOG, "a+") or die ("Ошибка открытия файла");
        fputs($file, $order . PHP_EOL);
    fclose($file);
}
//Создание файла и запись в файл конец
//Добавление заказа в БД
function saveOrder ($datetime) {
    global $link, $basket;
    $goods = myBasket();
    $stmt = mysqli_stmt_init($link);
    $sql = 'INSERT INTO orders (title,
                                author,
                                pubyear,
                                price,
                                quantity,
                                orderid,
                                datetime)
                        VALUES (?, ?, ?, ?, ?, ?, ?)';
    
    if (!mysqli_stmt_prepare($stmt, $sql))
        return false;
    foreach ($goods as $item) {
        mysqli_stmt_bind_param($stmt, "ssiiisi",
                                $item['title'], $item['author'],
                                $item['pubyear'], $item['price'],
                                $item['quantity'], $basket['orderid'],
                                $datetime);
        mysqli_stmt_execute ($stmt);
    }
    mysqli_stmt_close($stmt);
    setcookie('basket', "", 1);

    return true;
}
//Добавление заказа в БД конец

//ПРосмотр списка заказов
function getOrders () {
    global $link;

    if(!is_file(ORDERS_LOG)) 
        return false;
    /* Получаем в виде массива персональные данные пользователей из файла */
    $orders = file(ORDERS_LOG);
    /* Массив, который будет возвращен функцией */ 
    $allorders = [];
    foreach ($orders as $order) {
        list($name, $email, $phone, $address, $orderid, $date) = explode(" | ", trim($order));
        /* Промежуточный массив для хранения информации о конкретном заказе */
        $orderinfo = [];
        $orderinfo['name'] = $name;
        $orderinfo['email'] = $email;
        $orderinfo['phone'] = $phone;
        $orderinfo['address'] = $address;
        $orderinfo['orderid'] = $orderid;
        $orderinfo['date'] = $date;
        /* SQL-запрос на выборку из таблицы orders всех товаров для конкретного 
покупателя */ 
        $sql = "SELECT title, author, pubyear, price, quantity
                FROM orders
                WHERE orderid = '$orderid'";
//        echo $sql;
        /* Получение результата выборки */ 
        if(!$result = mysqli_query($link, $sql)) 
            return false;
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        /* Сохранение результата в промежуточном массиве */ 
        $orderinfo['goods'] = $items;
        /* Добавление промежуточного массива в возвращаемый массив */ 
        $allorders[] = $orderinfo;
    }
    return $allorders;
}