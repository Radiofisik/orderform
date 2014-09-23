<?php
include_once("class_order.php");
require_once('class_item.php');
require_once('../../../wp-load.php');
require_once ('./lib/nusoap.php'); 

$param = array( 'number' => '3'); 
$client = new nusoap_client('http://new.kgnic.ru/wp-content/plugins/orderform/webservice.php?wsdl'); 
//Call a function at server and send parameters too 
$response = $client->call('get_message',$param); 
//Process result 
if($client->fault) 
{ 
echo "FAULT: <p>Code: (".$client->faultcode."</p>"; 
echo "String: ".$client->faultstring; 
} 
else 
{ 
echo print_r($response); 
} 



?>