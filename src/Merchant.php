<?php


namespace Paynl\Alliance;

use Paynl\Error\Error;
use Paynl\Error\Required;

class Merchant
{

    public static function add($options)
    {
        $api = new Api\AddMerchant();

        if (isset($options['accounts'])) {
            self::_addAccounts($options['accounts'], $api);
        }

        if (isset($options['companyName'])) {
            $api->setCompanyName($options['companyName']);
        }
        if (isset($options['cocNumber'])) {
            $api->setCocNumber($options['cocNumber']);
        }
        if (isset($options['street'])) {
            $api->setStreet($options['street']);
        }
        if (isset($options['houseNumber'])) {
            $api->setHouseNumber($options['houseNumber']);
        }
        if (isset($options['postalCode'])) {
            $api->setPostalCode($options['postalCode']);
        }
        if (isset($options['city'])) {
            $api->setCity($options['city']);
        }
        if (isset($options['sendEmail'])) {
            $api->setSendEmail($options['sendEmail']);
        }
        if (isset($options['countryCode'])) {
            $api->setCountryCode($options['countryCode']);
        }
        if (isset($options['bankAccountOwner'])) {
            $api->setBankAccountOwner($options['bankAccountOwner']);
        }
        if (isset($options['bankAccountNumber'])) {
            $api->setBankAccountNumber($options['bankAccountNumber']);
        }
        if (isset($options['bankAccountBIC'])) {
            $api->setBankAccountBic($options['bankAccountBIC']);
        }
        if (isset($options['packageName'])) {
            $api->setPackageName($options['packageName']);
        }
        if (isset($options['settleBalance'])) {
            $api->setSettleBalance($options['settleBalance']);
        }
        if (isset($options['payoutInterval'])) {
            $api->setInvoiceInterval($options['payoutInterval']);
        }
        $result = $api->doRequest();

        return new Result\Merchant\Add($result);
    }

    /**
     * Add the accounts to the addMerchant API
     *
     * @param array $accounts
     * @param Api\AddMerchant $api
     * @throws Error
     * @throws Required
     */
    private static function _addAccounts(array $accounts, Api\AddMerchant $api)
    {
        if (count($accounts) == 0) {
            throw new Required('accounts');
        }
        $primaryAccount = null;
        $signees = array();
        if (count($accounts) == 1) {
            $primaryAccount = array_pop($accounts);
        } else {
            foreach ($accounts as $account) {
                if ($account['primary']) {
                    if (!is_null($primaryAccount)) {
                        throw new Error('You can only add 1 primary account');
                    }
                    $primaryAccount = $account;
                } else {
                    array_push($signees, $account);
                }
            }
        }
        if (is_null($primaryAccount)) {
            throw new Error('One account must be the primary account');
        }
        if (isset($primaryAccount['email'])) {
            $api->setEmail($primaryAccount['email']);
        }
        if (isset($primaryAccount['firstname'])) {
            $api->setFirstName($primaryAccount);
        }
        if (isset($primaryAccount['lastname'])) {
            $api->setLastName($primaryAccount['lastname']);
        }
        if (isset($primaryAccount['gender'])) {
            $api->setGender($primaryAccount['gender']);
        }
        if (isset($primaryAccount['authorisedToSign'])) {
            $api->setAuthorisedToSign($primaryAccount['authorisedToSign']);
        }
        if (isset($primaryAccount['ubo'])) {
            $api->setUbo($primaryAccount['ubo']);
        }
        if (!empty($signees)) {
            foreach ($signees as $signee) {
                if (empty($signee['email'])) {
                    throw new Required('account - email');
                }
                if (empty($signee['firstname'])) {
                    throw new Required('account - firstname');
                }
                if (empty($signee['lastname'])) {
                    throw new Required('account - lastname');
                }
                if (empty($signee['gender'])) {
                    throw new Required('account - gender');
                }
                if (empty($signee['authorisedToSign'])) {
                    $signee['authorisedToSign'] = 0;
                }
                if (empty($signee['ubo'])) {
                    $signee['ubo'] = 0;
                }
                $api->addSignee($signee['email'], $signee['firstname'], $signee['lastname'],
                    $signee['authorisedToSign'], $signee['ubo']);
            }
        }
    }

    public static function get($options)
    {
        $api = new Api\GetMerchant();
        if(isset($options['merchantId'])){
            $api->setMerchantId($options['merchantId']);
        }

        $result = $api->doRequest();

        return new Result\Merchant\Get($result);
    }

    public static function getList($options = array()){
        $api = new Api\GetMerchants();

        if(isset($options['state'])){
            $api->setState($options['state']);
        }

        $result = $api->doRequest();

        return new Result\Merchant\GetList($result);
    }

}