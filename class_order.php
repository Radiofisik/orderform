<?php
require_once('class_item.php');
include_once('check_inn.php');
class Order
{
public $Schet;
public $Comment;
public $Product;
public $Quantity;

public $FIO;
public $Organization;
public $BIK;
public $INN;
public $items;

function __construct() { }
  
    public function add()
    {
		include("dbs.php");
		$query="INSERT INTO order_table (fio, organization, bik, inn, account, comment) VALUES ('$this->FIO', '$this->Organization', '$this->BIK', '$this->INN', '$this->Schet', '$this->Comment')";
		mysqli_query($dbcnx, $query);
	    $seq = mysqli_insert_id ($dbcnx);
		echo $query;
		foreach ($this->items as $key => $val)
		{
			$query="INSERT INTO items (order_id, name, quantity) VALUES ('$seq','$val->Product', '$val->Quantity')";
			//echo $query;
			mysqli_query($dbcnx, $query);
		}
        return("<p>Ваша заявка принята, с вами свяжется ответственный исполнитель</p>");
    }
    
	
	public function setSchet($Schet)
    {	
		if(preg_match("/^\d{20}$/", $Schet))
		{
			$this->Schet = $Schet;
			return true;
		}   
		return false;
    } 
	
	public function setComment($Comment)
    {
		if(preg_match("/^.{0,512}$/", $Comment))
		{
			$this->Comment = htmlspecialchars($Comment);
			return true;
		}   
		return false;
    } 
	
	public function setFIO($FIO)
    {
		if (preg_match("/^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$/u", $FIO))
		{
			$this->FIO = $FIO;
			return true;
		}   
		return false;
    } 
	
	public function setBIK($BIK)
    {
		if (preg_match("/^[0-9]{9}$/", $BIK))
		{
			$this->BIK = $BIK;
			return true;
		}   
		return false;
    } 
	
	public function setINN($INN)
    {
		if (preg_match("/^[0-9]{10,12}$/", $INN))
		{
			$this->INN = $INN;
			if (is_valid_inn($this->INN))
			return true;
		}   
		return false;
    } 
	
		public function setOrganization($Organization)
    {
		if (preg_match("/^.{3,512}$/", $Organization))
		{
			$this->Organization = htmlspecialchars($Organization);
			return true;
		}   
		return false;
    } 
	
}
?>