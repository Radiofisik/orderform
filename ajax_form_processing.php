<?php
include_once("class_order.php");
require_once('class_item.php');

$OrderI = new Order();
if (!$OrderI->setOrganizationfull($_POST["Organizationfull"])){show_error("<br /> Укажите организацию");}
if (!$OrderI->setOrganizationshort($_POST["Organizationshort"])){show_error("<br /> Укажите организацию");}
if (!$OrderI->setFIOdir($_POST["FIOdir"])){show_error("<br /> ФИО может содержать только буквы русского алфавита");}
if (!$OrderI->setPositiondir($_POST["Positiondir"])){show_error("<br /> Укажите должность руководителя");}
if (!$OrderI->setReasondir($_POST["Reasondir"])){show_error("<br /> Укажите основание полномочий руководителя");}
if (!$OrderI->setPhonedir($_POST["Phonedir"])){show_error("<br /> Укажите телефон руководителя");}
if (!$OrderI->setFIOcont($_POST["FIOcont"])){show_error("<br /> ФИО может содержать только буквы русского алфавита");}
if (!$OrderI->setPositioncont($_POST["Positioncont"])){show_error("<br /> Укажите должность");}
if (!$OrderI->setPhonecont($_POST["Phonecont"])){show_error("<br /> Укажите телефон");}
if (!$OrderI->setEmail($_POST["Email"])){show_error("<br /> Введите эектронный адрес в формате address@domain.com");}
if (!$OrderI->setINN($_POST["INN"])){show_error("<br /> Неверный ИНН");}
if (!$OrderI->setKPP($_POST["KPP"])){show_error("<br /> Неверный КПП");}
if (!$OrderI->setOGRN($_POST["OGRN"])){show_error("<br /> Неверный ОГРН!");}
if (!$OrderI->setSchet($_POST["Schet"])) {show_error("<br /> Неверный счет");}
if (!$OrderI->setKorrschet($_POST["Korrschet"])) {show_error("<br /> Неверный счет");}
if (!$OrderI->setBIK($_POST["BIK"])){show_error("<br /> Неверный БИК");}
if (!$OrderI->setBankname($_POST["Bankname"])){show_error("<br /> Укажите банк");}
if (!$OrderI->setAddrlegal($_POST["Addrlegal"])){show_error("<br /> Укажите адрес");}
if (!$OrderI->setAddrfact($_POST["Addrfact"])){show_error("<br /> Укажите адрес");}
if (!$OrderI->setComment($_POST["Comment"])) {show_error("<br /> Неверный коментарий");}


$counter=0;
$ProductName="Product1";
$QuantityName="Quantity1";
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
<body>
<p>Пожалуйста, исправьте следующую ошибку:</p>
<?php echo $myError; ?>
</body>
</html>
<?php
die();
exit();
}
?>