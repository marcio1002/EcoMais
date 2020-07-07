<?php
namespace Ecomais\Controllers\User;

use Ecomais\Controllers\AccountManager;
use Ecomais\Models\{DataException,Person,Safety};
use Ecomais\ControllersServices\AccountHandling;

class AccountManagerUser {

    private AccountHandling $account;
    private Person $usr;
    private Safety $safety;

    function __Construct() 
    {
        $this->usr = new Person();
        $this->account = new AccountHandling();
        $this->safety = new Safety();
    }

    public function  createAccount($param): void
    {
        try {

            $this->usr->name = filter_var($param['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->email = filter_var($param['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->passwd = filter_var($param['passwd'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->cep = filter_var($param['cep'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->uf = filter_var($param['uf'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->addres = filter_var($param['addres'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->locality = filter_var($param['locality'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->usr->statusAccount = Person::ENABLED;

            if ($this->account->createAccountPersonPhysical($this->usr)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            die(header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error"));
        }
    }

    public function updateAccount(): void
    {
        try {

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function  deleteAccount($param): void
    {
        try {

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}