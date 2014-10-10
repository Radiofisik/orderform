<?php
require_once('class_item.php');
include_once('check_inn.php');
class Order
{
public $Organizationfull;
public $Organizationshort;
public $FIOdir;
public $Positiondir;
public $Reasondir;
public $Phonedir;
public $FIOcont;
public $Positioncont;
public $Phonecont;
public $Email;
public $INN;
public $KPP;
public $OGRN;
public $Schet;
public $Korrschet;
public $BIK;
public $Bankname;
public $Addrlegal;
public $Addrfact;
public $Comment;
public $Product;
public $Quantity;
public $items;

function __construct() { }
  
  //plain php database add has been marked as deprectated and not supported anymore
    public function add()
    {
		include("dbs.php");
		$query="INSERT INTO order_table (Organizationfull, Organizationshort, FIOdir, Positiondir, Reasondir, Phonedir, FIOcont, Positioncont, Phonecont, Email, INN, KPP, OGRN, Schet,Korrschet,BIK,Bankname,Addrlegal,Addrfact,Comment) VALUES ('$this->Organizationfull', '$this->Organizationshort', '$this->FIOdir', '$this->Positiondir', '$this->Reasondir', '$this->Phonedir', '$this->FIOcont', '$this->Positioncont', '$this->Phonecont', '$this->Email', '$this->INN', '$this->KPP', '$this->OGRN', '$this->Schet', '$this->Korrschet', '$this->BIK', '$this->Bankname', '$this->Addrlegal', '$this->Addrfact', '$this->Comment')";
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
    
	//wp database add
	    public function wpadd()
    {
	require_once('../../../wp-load.php');
		global $wpdb;
		$tablename= $wpdb->prefix."orders";
		$data=array(
						'Organizationfull'=>$this->Organizationfull,
						'Organizationshort'=>$this->Organizationshort,
						'FIOdir'=>$this->FIOdir,
						'Positiondir'=>$this->Positiondir,
						'Reasondir'=>$this->Reasondir,
						'Phonedir'=>$this->Phonedir,
						'FIOcont'=>$this->FIOcont,
						'Positioncont'=>$this->Positioncont,
						'Phonecont'=>$this->Phonecont,
						'Email'=>$this->Email,
						'INN'=>$this->INN,
						'KPP'=>$this->KPP,
						'OGRN'=>$this->OGRN,
						'Schet'=>$this->Schet,
						'Korrschet'=>$this->Korrschet,
						'BIK'=>$this->BIK,
						'Bankname'=>$this->Bankname,
						'Addrlegal'=>$this->Addrlegal,
						'Addrfact'=>$this->Addrfact,
						'Comment'=>$this->Comment
					);
		$wpdb->insert($tablename,$data);		
		
		$tablename= $wpdb->prefix."items";
		$lastid=$wpdb->insert_id;
		foreach ($this->items as $key => $val)
		{
		$data=array('order_id'=>$lastid,
						'name'=>$val->Product,
						'quantity'=>$val->Quantity
						);
		$wpdb->insert($tablename,$data);		
		}
        return("<p>Ваша заявка принята, с вами свяжется ответственный исполнитель</p>");
    }
	
	public function setOrganizationfull($Organizationfull)
    {
		if (preg_match("/^.{3,512}$/", $Organizationfull))
		{
			$this->Organizationfull = htmlspecialchars($Organizationfull);
			return true;
		}   
		return false;
    } 
	
	public function setOrganizationshort($Organizationshort)
    {
		if (preg_match("/^.{3,512}$/", $Organizationshort))
		{
			$this->Organizationshort = htmlspecialchars($Organizationshort);
			return true;
		}   
		return false;
    } 
	
	public function setFIOdir($FIOdir)
    {
		if (preg_match("/^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$/u", $FIOdir))
		{
			$this->FIOdir = $FIOdir;
			return true;
		}   
		return false;
	}
 	
	public function setPositiondir($Positiondir)
    {
		if (preg_match("/^[а-яА-ЯёЁ]{1,50}$/u", $Positiondir))
		{
			$this->Positiondir = $Positiondir;
			return true;
		}   
		return false;
	}
	
		public function setReasondir($Reasondir)
    {
		if (preg_match("/^[а-яА-ЯёЁ]{1,50}$/u", $Reasondir))
		{
			$this->Reasondir = $Reasondir;
			return true;
		}   
		return false;
	}
	
	public function setPhonedir($Phonedir)
    {	
		if(preg_match("/^(\d|\W){6,17}$/", $Phonedir))
		{
			$this->Phonedir = $Phonedir;
			return true;
		}   
		return false;
	}

	public function setFIOcont($FIOcont)
    {
		if (preg_match("/^([а-яА-ЯёЁ]{1,50}\s{0,1}){1,3}$/u", $FIOcont))
		{
			$this->FIOcont = $FIOcont;
			return true;
		}   
		return false;
	} 	
	
	public function setPositioncont($Positioncont)
    {
		if (preg_match("/^.{3,512}$/", $Positioncont))
		{
			$this->Positioncont = $Positioncont;
			return true;
		}   
		return false;
	}
	
	public function setPhonecont($Phonecont)
    {	
		if(preg_match("/^(\d|\W){6,17}$/", $Phonecont))
		{
			$this->Phonecont = $Phonecont;
			return true;
		}   
		return false;
	}
	
	public function setEmail($Email)
    {
		if (preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $Email))
		{
			$this->Email = htmlspecialchars($Email);
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
	
		public function setKPP($KPP)
    {
		if (preg_match("/^[0-9]{9}$/", $KPP))
		{
			$this->KPP = $KPP;
			return true;
		}   
		return false;
    } 
	
		public function setOGRN($OGRN)
    {
		if (preg_match("/^[0-9]{13,15}$/", $OGRN))
		{
			$this->OGRN = $OGRN;
			return true;
		}   
		return false;
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
	
		public function setKorrschet($Korrschet)
    {	
		if(preg_match("/^\d{20}$/", $Korrschet))
		{
			$this->Korrschet = $Korrschet;
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
	
	public function setBankname($Bankname)
    {
		if (preg_match("/^.{3,512}$/", $Bankname))
		{
			$this->Bankname = htmlspecialchars($Bankname);
			return true;
		}   
		return false;
    } 
	
		public function setAddrlegal($Addrlegal)
    {
		if (preg_match("/^.{3,512}$/", $Addrlegal))
		{
			$this->Addrlegal = htmlspecialchars($Addrlegal);
			return true;
		}   
		return false;
    } 
	
			public function setAddrfact($Addrfact)
    {
		if (preg_match("/^.{3,512}$/", $Addrfact))
		{
			$this->Addrfact = htmlspecialchars($Addrfact);
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
	
	
   
	
	
	
	
	
		
	
}
?>