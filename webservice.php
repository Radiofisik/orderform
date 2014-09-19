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
	return $result; 
} 

//using soap_server to create server object 
$server = new soap_server; 

//register a function that works on server 
//$server->register('get_message'); 
$server->configureWSDL('myname', 'urn:mynamespace');
$server->register('get_message',
    array('number' => 'xsd:string'),
    array('output' => 'xsd:string'),
    'xsd:mynamespace');
	
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
// create HTTP listener 
$server->service($HTTP_RAW_POST_DATA); 
exit(); 
		

?>