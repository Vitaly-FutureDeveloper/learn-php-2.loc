<?
$subject = trim (strip_tags ($_POST['subject']));
$body = strip_tags ($_POST['body']);

ini_set ("SMTP", "localhost");
ini_set ("smtp_port", "25");
ini_set ("sendmail_from", "hacker@localhost.loc");

if ( !empty($subject) && !empty($body) ) {
	if (mail("utlcngokb@emlhub.com", $subject, $body))
		echo "Письмо отправлено";
}


?>

<h3>Адрес</h3>
<p>123456 Москва, Малый Американский переулок 21</p>
<h3>Задайте вопрос</h3>
<form action='<?= $_SERVER['REQUEST_URI']?>' method='post'>
	<label>Тема письма: </label><br />
	<input name='subject' type='text' size="50"/><br />
	<label>Содержание: </label><br />
	<textarea name='body' cols="50" rows="10"></textarea><br /><br />
	<input type='submit' value='Отправить' />
</form>	