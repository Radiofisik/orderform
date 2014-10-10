<?php
include_once("class_order.php");
require_once('class_item.php');
require_once('../../../wp-load.php');
require_once ('./lib/nusoap.php'); 

function LoadOrders()
{
//load orders from database
	$orders;
		global $wpdb;
		$tablename= $wpdb->prefix."orders";
		$orderq = $wpdb->get_results("
									SELECT id, Organizationfull, Organizationshort, FIOdir, Positiondir, Reasondir, Phonedir,FIOcont,Positioncont,Phonecont,Email,INN,KPP,OGRN,Schet,Korrschet,BIK,Bankname,Addrlegal,Addrfact,Comment
									FROM $tablename
									");

		foreach ( $orderq as $orderqi ) // 'i' means instance
		{
		$OrderI = new Order();
			//echo $orderqi->organization;
			
			$OrderI->setOrganizationfull($orderqi->Organizationfull);
			$OrderI->setOrganizationshort($orderqi->Organizationshort);
			$OrderI->setFIOdir($orderqi->FIOdir);
			$OrderI->setPositiondir($orderqi->Positiondir);
			$OrderI->setReasondir($orderqi->Reasondir);
			$OrderI->setPhonedir($orderqi->Phonedir);
			$OrderI->setFIOcont($orderqi->FIOcont);
			$OrderI->setPositioncont($orderqi->Positioncont);
			$OrderI->setPhonecont($orderqi->Phonecont);
			$OrderI->setEmail($orderqi->Email);
			$OrderI->setINN($orderqi->INN);
			$OrderI->setKPP($orderqi->KPP);
			$OrderI->setOGRN($orderqi->OGRN);
			$OrderI->setSchet($orderqi->Schet);
			$OrderI->setKorrschet($orderqi->Korrschet);
			$OrderI->setBIK($orderqi->BIK);
			$OrderI->setBankname($orderqi->Bankname);
			$OrderI->setAddrlegal($orderqi->Addrlegal);
			$OrderI->setAddrfact($orderqi->Addrfact);
			$OrderI->setComment($orderqi->Comment);
			$order_id=$orderqi->id;
			
			$tablenameitem= $wpdb->prefix."items";
			$itemsr = $wpdb->get_results("
										SELECT name, quantity
										FROM $tablenameitem
										WHERE order_id=$order_id
										");
				foreach ( $itemsr as $itemsri ) // 'i' means instance
				{	
				$citem=new item(); //'c' meand current
				$citem->setProduct($itemsri->name);
				$citem->setQuantity($itemsri->quantity);
				$OrderI->items[]=$citem;
				}					
			$orders[]=$OrderI;
		}
		//print_r($orders);	
		return $orders;
}
		
// create the function 
function get_message($number) 
{ 
	if(!$number){ 
	return new soap_fault('Client','','Put Your number!'); 
	} 
	$orders[]=LoadOrders();
	$resstr=$orders[0];
	//return "teststring";
	return $resstr; 
} 

//using soap_server to create server object 
$server = new soap_server; 
$server->soap_defencoding = 'utf-8';
$server->decode_utf8 = false;
//register a function that works on server 
//$server->register('get_message'); 
$server->configureWSDL('myname', 'urn:mynamespace');

$server->wsdl->addComplexType(
    'orderItem',
    'complexType',
    'struct',
    'all',
    '',
    array('Product' => array('name'=>'Product','type'=>'xsd:string'),
        'Quantity' => array('name'=>'Quantity','type'=>'xsd:int'))
);

$server->wsdl->addComplexType(
    'orderItemArray',    // Name
    'complexType',    // Type Class
    'array',          // PHP Type
    '',               // Compositor
    'SOAP-ENC:Array', // Restricted Base
    array(),
    array(
        array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:orderItem[]')
    ),
    'tns:orderItem'
);

$server->wsdl->addComplexType(
    'order',
    'complexType',
    'struct',
    'all',
    '',
    array(
	'Organizationfull' => array('name'=>'Organizationfull','type'=>'xsd:string'),
    'Organizationshort' => array('name'=>'Organizationshort','type'=>'xsd:string'),
    'FIOdir' => array('name'=>'FIOdir','type'=>'xsd:string'),
    'Positiondir' => array('name'=>'Positiondir','type'=>'xsd:string'),
    'Reasondir' => array('name'=>'Reasondir','type'=>'xsd:string'),
    'Phonedir' => array('name'=>'Phonedir','type'=>'xsd:string'),
	'FIOcont' => array('name'=>'FIOcont','type'=>'xsd:string'),
	'Positioncont' => array('name'=>'Positioncont','type'=>'xsd:string'),
	'Phonecont' => array('name'=>'Phonecont','type'=>'xsd:string'),
	'Email' => array('name'=>'Email','type'=>'xsd:string'),
	'INN' => array('name'=>'INN','type'=>'xsd:string'),
	'KPP' => array('name'=>'KPP','type'=>'xsd:string'),
	'OGRN' => array('name'=>'OGRN','type'=>'xsd:string'),
	'Schet' => array('name'=>'Schet','type'=>'xsd:string'),
	'Korrschet' => array('name'=>'Korrschet','type'=>'xsd:string'),
	'BIK' => array('name'=>'BIK','type'=>'xsd:string'),
	'Bankname' => array('name'=>'Bankname','type'=>'xsd:string'),
	'Addrlegal' => array('name'=>'Addrlegal','type'=>'xsd:string'),
	'Addrfact' => array('name'=>'Addrfact','type'=>'xsd:string'),
	'Comment' => array('name'=>'Comment','type'=>'xsd:string'),
		
	'items' => array('name'=>'items','type'=>'tns:orderItemArray')
        )
);

$server->wsdl->addComplexType(
    'orderArray',    // Name
    'complexType',    // Type Class
    'array',          // PHP Type
    '',               // Compositor
    'SOAP-ENC:Array', // Restricted Base
    array(),
    array(
        array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:order[]')
    ),
    'tns:order'
);
 
/*$server->register('get_message',
    array('number' => 'xsd:string'),
    array('output' => 'tns:orderArray'),
    'xsd:mynamespace');*/
$server->register('get_message',
    array('number' => 'xsd:string'),
    array('output' => 'tns:orderArray'),
    'xsd:mynamespace');
	
	
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
// create HTTP listener 
$server->service($HTTP_RAW_POST_DATA); 
exit(); 
		

?>