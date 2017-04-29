<?php
require_once "header.php";

echo "<center><h2><b>Отравка писем запущена</b></h2></center><hr>";

ini_set('max_execution_time', 30000); //максимальное время выполнения скрипта 30000 сек (8 часов)

$odr = "\n\n\n Для отказа от подписки воспользуйтесь ссылкой\n";
$homepage = "http://email.yandex/ras.php";

$subject = $_POST["subject"];
$fromemail = $_POST["fromemail"];
$body = $_POST["body"];
$subject = stripslashes($subject);
$fromemail = "=?utf-8?B?".base64_encode($fromemail)."?=";
$subject = "=?utf-8?B?".base64_encode($subject)."?=";
$type_mail = "Content-type: text/html; charset=\"utf-8\""; // тип файла html
//$body = stripslashes($body);

//тестовая часть передачи с формы
$header_body = $_POST["header_body"];
$header_body = stripslashes($header_body);
$offer_one = $_POST["offer_one"];
$offer_one = stripslashes($offer_one);
$offer_two = $_POST["offer_two"];
$offer_two = stripslashes($offer_two);
$offer_three = $_POST["offer_three"];
$offer_three = stripslashes($offer_three);
$offer_four = $_POST["offer_four"];
$offer_four = stripslashes($offer_four);
$offer_five = $_POST["offer_five"];
$offer_five = stripslashes($offer_five);
$offer_six = $_POST["offer_six"];
$offer_six = stripslashes($offer_six);
$offer_seven = $_POST["offer_seven"];
$offer_seven = stripslashes($offer_seven);
$footer_body = $_POST["footer_body"];
$footer_body = stripslashes($footer_body);
$signature_body = $_POST["signature_body"];
$signature_body = stripslashes($signature_body);
$unsubscribing_mail = $_POST["unsubscribing_mail"];
$unsubscribing_mail = stripslashes($unsubscribing_mail);
$unsubscribing_mail = "=?utf-8?B?".base64_encode($unsubscribing_mail)."?=";

//создаем временной файл и записываем в него данные с полей

$array_offer = array (
$offer_one,
$offer_two,
$offer_three,
$offer_four,
$offer_five,
$offer_six,
$offer_seven
); //массив с полями предложения offer

$file = "maillist.txt";
$maillist = file($file);

print "В базе ". sizeof($maillist) ." адресов<br>";

for ($i = 0; $i < sizeof($maillist);$i++) {
		shuffle ($array_offer); // перемешиваем массив во время каждой интерации
		$array_offer_good = implode("<br>\n- ", $array_offer); //поставилиc с новой строки, тире и  пробелы между предложениями
		if (($i % 10) == 1) { // если остача при делении $i на 10 равно 1 - идет длинная пауза
			$full_t = rand (4, 6);
			sleep ($full_t);
			echo "<b>Задержка отправки ".$full_t." сек - </b>";
		} 
		else { // во всех остальных случаях пауза маленькая 
		$t = rand (1, 3);
		sleep($t);
		echo "Здесь была пауза ".$t." сек - ";
		}
	echo(" почта <b>".$maillist[$i]." - </b> Отправлено!<br>");
	$body = $header_body. "<br>\n- ". $array_offer_good. "<br><br>\n\n". $footer_body. "<br><br><br>\n\n\n". $signature_body;
	mail($maillist[$i], $subject,
$body,
"List-Unsubscribe: $unsubscribing_mail". "\n$type_mail". "\nFrom: $fromemail". "\n$type_mail");
	ob_flush();
        flush();
}

echo "Готово!";
ob_end_flush();

/*
print "В базе ". sizeof($maillist) ." адресов<br>";

for ($i = 0; $i < sizeof($maillist); $i++)
{
echo($maillist[$i]."<br>");
mail($maillist[$i], $subject,
$body ."$odr $homepage?delmail=$maillist[$i]", // "$odr $homepage?delmail=$maillist[$i]" - GET запрос на удаление адреса с рассылки
"From: $fromemail");
}
echo "Готово!";
*/

require_once "footer.php";
?>