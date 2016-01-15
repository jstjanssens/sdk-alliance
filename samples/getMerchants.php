<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try{
	$merchant = Paynl\Alliance\Merchant::getList(array('state' => 'accepted'));

	$merchants = $merchant->getMerchants();

	foreach($merchants as $merchant){
		echo $merchant->getMerchantId().' '.$merchant->getMerchantName()."<br />";
	}
} catch(Exception $e){
    echo "Error occurred: ". $e->getMessage();
}