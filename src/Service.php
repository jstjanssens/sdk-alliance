<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 14-1-2016
 * Time: 19:02
 */

namespace Paynl\Alliance;


use Paynl\Alliance\Api;

class Service
{
    public static function add($options)
    {
        $api = new Api\AddService();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }
        if (isset($options['name'])) {
            $api->setName($options['name']);
        }
        if (isset($options['description'])) {
            $api->setDescription($options['description']);
        }
        if (isset($options['categoryId'])) {
            $api->setCategoryId($options['categoryId']);
        }
        if (isset($options['url'])) {
            $api->setPublication($options['url']);
        }
        if (isset($options['alwaysSendExchange'])) {
            $api->setAlwaysSendExchange($options['alwaysSendExchange']);
        }
        if (isset($options['extraUrls'])) {
            $api->setPublicationUrls($options['extraUrls']);
        }
        if (isset($options['paymentOptions'])) {
            $api->setPaymentOptions($options['paymentOptions']);
        }

        $result = $api->doRequest();

        return new Result\Service\Add($result);
    }

    public static function getCategories($options = array())
    {
        $api = new Api\GetCategories();
        $result = $api->doRequest();

        return new Result\Service\GetCategories($result);
    }
}