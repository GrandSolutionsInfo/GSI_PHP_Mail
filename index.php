<?php
require_once "header.php";

$pass = $_POST["pass"];
$subject = "Администрация сайта Grand Solutions Info"; // тема рассылки
$fromemail = "info@grand-solutions.info"; // ваш адрес (для ответов)
$file = "maillist.txt"; // список адресов подписчиков
$maillist = file($file);
$password = "1234zz"; // ваш пароль для рассылки

//чтобы не вводить
$header_body = "Здравствуйте, проект Grand Solutions Info подготовил специальные предложения для Вас.\n<br>";
$offer_one = "Интернет-магазин - от $99";
$offer_two = "Сайт-визитка - от $49";
$offer_three = "Корпоративный сайт - от $69";
$offer_four = "IP-телефония - от $2/мес"; 
$offer_five = "Номер США - от $2/мес"; 
$offer_six = "Мобильный номер РФ - от $3/мес"; 
$offer_seven = "Обущение персонала - от $89/сотрудник"; 
$footer_body = "Предложение действительно до <b>01 июня 2017 года</b> и доступно только предъявителю данного письма."; 
$signature_body = "<br>\n--<br>\nGrand Solutions Info<br><br>\n\nTel.:<br>\n+ 7(499)322-72-88 (Moscow, Russian Federation)<br>\n+ 38(044)338-59-40 (Kiev, Ukraine)<br>\n+ 48(22)307-36-88 (Warsaw, Poland)<br><br>\n\ne-mail: info@grand-solutions.info"; 
$unsubscribing_mail = "sales@grand-solutions.info"; 

if ($pass == $password) // если пароль ввели правильный
// то выводим форму с полями для ввода:
// адрес отправителя, текст письма, тело письма
// кнопку для отправления
// после нажатия на кнопку, передаем данные скрипту send.php
// добавить поле ввода пароля для отрпавки
{
	echo "<center><h2><b>Шаблон письма для отправки</b></h2></center>";
echo "<font size=\"-1\"><hr><form method=\"POST\" action=\"send.php\">";
echo "<center>Отправитель - <input type=\"text\" name=\"fromemail\" value=\"$fromemail\" size=\"39\"><br><hr>";
echo "Тема письма - <input type=\"text\" name=\"subject\" value=\"$subject\" size=\"39\"><br><hr>";
echo "Шапка письма:<br><textarea name=\"header_body\" rows=\"4\" cols=\"50\">$header_body</textarea><br><hr>";
echo "Предложение 1 - <input type=\"text\" name=\"offer_one\" value=\"$offer_one\" size=\"39\"><br><hr>";
echo "Предложение 2 - <input type=\"text\" name=\"offer_two\" value=\"$offer_two\" size=\"39\"><br><hr>";
echo "Предложение 3 - <input type=\"text\" name=\"offer_three\" value=\"$offer_three\" size=\"39\"><br><hr>";
echo "Предложение 4 - <input type=\"text\" name=\"offer_four\" value=\"$offer_four\" size=\"39\"><br><hr>";
echo "Предложение 5 - <input type=\"text\" name=\"offer_five\" value=\"$offer_five\" size=\"39\"><br><hr>";
echo "Предложение 6 - <input type=\"text\" name=\"offer_six\" value=\"$offer_six\" size=\"39\"><br><hr>";
echo "Предложение 7 - <input type=\"text\" name=\"offer_seven\" value=\"$offer_seven\" size=\"39\"><br><hr>";
echo "Подвал письма:<br><textarea name=\"footer_body\" rows=\"4\" cols=\"50\">$footer_body</textarea><br><hr>";
echo "Подпись письма:<br><textarea name=\"signature_body\" rows=\"6\" cols=\"50\">$signature_body</textarea><br><hr>";
echo "Почта для отписки<br><input type=\"text\" name=\"unsubscribing_mail\" value=\"$unsubscribing_mail\" size=\"25\">";
echo "Введите пароль для подтверждения<br><input type=\"password\" name=\"password\" value=\"\" size=\"15\">";
echo "<br><br><input type=\"submit\" value=\"Запустить рассылку\"></center></form></font>";

print "<i>В базе<b> ". sizeof($maillist) ."</b> адресов</i><br><hr>";
for ($i = 0; $i < sizeof ($maillist); $i++) print $maillist[$i]. "<br>";
}
// если пароль неверный - просим ввести еще раз
else echo "<center><hr><br>Введите пароль<br><form method=\"POST\" action=\"index.php\"><input type=\"password\" name=\"pass\" value=\"\"><br><hr><input type=\"submit\" value=\"Войти\"></form><hr></center>";

require_once "footer.php";
?>