<?php
class item
{
public $Product;
public $Quantity;

public function setProduct($Product)
    {	
		if(preg_match("/^.{5,2048}$/", $Product))
		{
			$this->Product = htmlspecialchars($Product);
			return true;
		}   
		return false;
    } 
public function setQuantity($Quantity)
    {	
		if(preg_match("/^\d{1,3}$/", $Quantity))
		{
			$this->Quantity = $Quantity;
			return true;
		}   
		return false;
    } 
}
?>