<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $merchant = Paynl\Alliance\Merchant::get(array('merchantId' => 'M-1699-0230'));
    $data = $merchant->getData();

    var_dump($data);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}

