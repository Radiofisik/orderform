<?php
include_once("class_order.php");
require_once('class_item.php');

$OrderI = new Order();
if (!$OrderI->setFIO($_POST["FIO"])) {show_error("<br /> ФИО может содержать только буквы русского алфавита");}
if (!$OrderI->setOrganization($_POST["Organization"])){show_error("<br /> Укажите организацию");}
if (!$OrderI->setBIK($_POST["BIK"])){show_error("<br /> Неверный БИК");}
if (!$OrderI->setINN($_POST["INN"])){show_error("<br /> Неверный ИНН");}
if (!$OrderI->setSchet($_POST["Schet"])) {show_error("<br /> Неверный счет");}
if (!$OrderI->setComment($_POST["Comment"])) {show_error("<br /> Неверный коментарий");}



$counter=0;
$ProductName="Product";
$QuantityName="Quantity";
while (true){
	if(isset($_POST["$ProductName"]))
	{
		$OrderI->items[]=new item();
		if (!$OrderI->items[$counter]->setProduct($_POST["$ProductName"])) {show_error("<br /> продукт еггог");}
		if (!$OrderI->items[$counter]->setQuantity($_POST["$QuantityName"])) {show_error("<br /> мы столько не продаем");}
	}
	else break;
	$counter=$counter+1;
	$ProductName=$ProductName."1";
	$QuantityName=$QuantityName."1";
}

$out=$OrderI->wpadd(); 
echo $out;
	
	
function show_error($myError)
{
?>
<html>
  <head>
    <meta charset="utf-8">
	</head>
	<body>
	<p>Пожалуйста, исправьте следующую ошибку:</p>
	<?php echo $myError; ?>
	</body>
</html>
<?php
exit();
}
?>