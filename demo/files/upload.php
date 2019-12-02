<?php
$dir = "uploaad/";

echo "<pre>";
	var_dump ($_FILES);
echo "</pre>";

?>


<pre>
<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		print_r($_FILES);

	if(!is_dir($dir))
		mkdir($dir);
	
	if ( $_FILES['userfile']['error'] ) {

		switch ( $_FILES['userfile']['error'] ){
			case UPLOAD_ERR_INI_SIZE:
				echo "Превышен максимально допустимый размер"; break;
			case UPLOAD_ERR_FORM_SIZE:
				echo "Превышено максимальное значение MAX_FILE_SIZE"; break;
			case UPLOAD_ERR_PARTIAL:
				echo "Файл Загружен частично"; break;
			case UPLOAD_ERR_NO_FILE:
				echo "Файл не был загружен"; break;
			case UPLOAD_ERR_NO_TMP_DIR:
				echo "Отсутствует временная папка"; break;
			case UPLOAD_ERR_CANT_WRITE:
				echo "Не удалось записать файл на диск"; 
		}

	} else {
		echo "Размер загруженного файла: " . $_FILES['userfile']['size'];
		echo ". Тип загруженного файла: " . $_FILES['userfile']['type'] . ".";
		move_uploaded_file($_FILES['userfile']['tmp_name'] , $dir . $_FILES['userfile']['name']);
	}
	
	}
?>
<form action='upload.php' method='post' enctype='multipart/form-data'>
<input type="hidden" name="MAX_FILE_SIZE" value="409600000">
<input type='file' name='userfile'>
<input type='submit'>
</form>
