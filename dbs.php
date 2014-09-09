<?php
$dblocation = "localhost"; // Имя сервера
$dbuser = "root";          // Имя пользователя
$dbpasswd = "usbw";            // Пароль
$site_db = "orders";
$dbcnx = mysqli_connect($dblocation,$dbuser,$dbpasswd,$site_db);
if (!$dbcnx) // Если дескриптор равен 0 соединение не установлено
{
  echo("<P>В настоящий момент сервер базы данных не доступен, поэтому 
           корректное отображение страницы невозможно.</P>");
  exit();
}
$dbcnx->set_charset('utf8');
?>