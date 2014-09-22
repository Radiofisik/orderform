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
									SELECT id, fio, organization, bik, inn, account, comment
									FROM $tablename
									");

		foreach ( $orderq as $orderqi ) // 'i' means instance
		{
		$OrderI = new Order();
			//echo $orderqi->organization;
			
			$OrderI->setFIO($orderqi->fio);
			$OrderI->setOrganization($orderqi->organization);
			$OrderI->setBIK($orderqi->bik);
			$OrderI->setINN($orderqi->inn);
			$OrderI->setSchet($orderqi->account);
			$OrderI->setComment($orderqi->comment);
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
    array('FIO' => array('name'=>'FIO','type'=>'xsd:string'),
    'Organization' => array('name'=>'Organization','type'=>'xsd:string'),
    'BIK' => array('name'=>'BIK','type'=>'xsd:string'),
    'INN' => array('name'=>'INN','type'=>'xsd:string'),
    'Schet' => array('name'=>'Schet','type'=>'xsd:string'),
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