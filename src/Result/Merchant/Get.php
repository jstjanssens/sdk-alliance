<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 16:45
 */

namespace Paynl\Alliance\Result\Merchant;


class Get extends Merchant
{
    public function getBalance()
    {
        return $this->data['balance']/100;
    }
    public function getDocuments(){
        return $this->data['documents'];
    }
    public function getMissingDocuments(){
        $result = array();

        foreach($this->data['documents'] as $document){
            // status 2 = wordt gecontroleerd, 3 = goed
            if(!in_array($document['status_id'], array(2,3))){
                array_push($result, $document);
            }
        }

        return $result;
    }

    public function getAccounts(){
        return $this->data['accounts'];
    }

}