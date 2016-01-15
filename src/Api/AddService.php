<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 14-1-2016
 * Time: 16:11
 */

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;

class AddService extends Api
{
    protected $version = 2;

    /**
     * @var string
     */
    private $_merchantId;
    /**
     * @var string
     */
    private $_name;
    /**
     * @var string
     */
    private $_description;
    /**
     * @var int the Category of the service use Paynl\Alliance\Service::getCategories to get a list
     */
    private $_categoryId;
    /**
     * @var string the publication url
     */
    private $_publication;

    /**
     * @var array Duplicate content urls
     */
    private $_publicationUrls = array();

    /**
     * @var array The enabled payment methods, with settings
     */
    private $_paymentOptions = array();

    /**
     * @var bool Set to false to only receive an exchange call for paid transactions (not cancel, pending, refund etc.)
     */
    private $_alwaysSendExchange = true;

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->_merchantId = $merchantId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->_categoryId = $categoryId;
    }

    /**
     * @param string $publication
     */
    public function setPublication($publication)
    {
        $this->_publication = $publication;
    }

    /**
     * @param array $publicationUrls
     */
    public function setPublicationUrls($publicationUrls)
    {
        $this->_publicationUrls = (array)$publicationUrls;
    }

    /**
     * @param array $paymentOptions
     */
    public function setPaymentOptions($paymentOptions)
    {
        $this->_paymentOptions = $paymentOptions;
    }

    /**
     * @param boolean $alwaysSendExchange
     */
    public function setAlwaysSendExchange($alwaysSendExchange)
    {
        $this->_alwaysSendExchange = (bool)$alwaysSendExchange;
    }

    protected function getData()
    {
        if (!isset($this->_merchantId)) {
            throw new Required('merchantId');
        }
        $this->data['merchantId'] = $this->_merchantId;

        if (!isset($this->_name)) {
            throw new Required('name');
        }
        $this->data['name'] = $this->_name;

        if (!isset($this->_description)) {
            throw new Required('description');
        }
        $this->data['description'] = $this->_description;

        if (!isset($this->_categoryId)) {
            throw new Required('categoryId');
        }
        $this->data['categoryId'] = $this->_categoryId;

        if (!isset($this->_publication)) {
            throw new Required('publication');
        }
        $this->data['publication'] = $this->_publication;

        if (!empty($this->_publicationUrls)) {
            $this->data['publicationUrls'] = $this->_publicationUrls;
        }
        if (!empty($this->_paymentOptions)) {
            $this->data['paymentOptions'] = $this->_paymentOptions;
        }
        if (isset($this->_alwaysSendExchange)) {
            $this->data['alwaysSendExchange'] = $this->_alwaysSendExchange;
        }

        return parent::getData();
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/addService');
    }
}