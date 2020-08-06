<?php
namespace Ecomais\Controllers\User;

use Ecomais\Models\{DataException,Person};
use Ecomais\ControllersServices\AccountHandling;

class AccountManagerUser {

    private AccountHandling $account;
    private Person $usr;

    function __Construct() 
    {
        $this->usr = new Person();
        $this->account = new AccountHandling();
    }

    public function  createAccount($param): void
    {
        try {
            $this->usr->name = filter_var($param['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->email = filter_var($param['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->passwd = filter_var($param['passwd'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->cep = filter_var($param['cep'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->uf = filter_var($param['uf'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->address = filter_var($param['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->locality = filter_var($param['locality'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->statusAccount = Person::ENABLED;
            $this->usr->createAt();

            if ($this->account->createAccountPersonPhysical($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }
}