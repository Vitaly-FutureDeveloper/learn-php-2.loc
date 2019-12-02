<?
if (is_file("log/" . PATH_LOG)) {

    $lines = file("log/" . PATH_LOG);

    /* Чисто посмотреть как пашет функция file()
    echo "<pre>";
    var_dump($lines);
    echo "</pre>";
    */
    
    foreach ($lines as $key => $arr) {
        echo "<p>";
            echo $key . ' — ' . $arr;
        echo "</p>";
    }
}