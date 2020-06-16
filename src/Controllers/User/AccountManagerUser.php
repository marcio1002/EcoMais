<?php
namespace Ecomais\Controllers\User;

use Ecomais\Models\{DataException,Person};
use Ecomais\ControllersServices\AccountHandling;

class AccountManagerUser {

    private $account;
    private $usr;

    function __Construct() 
    {
        $this->usr = new Person();
        $this->account = new AccountHandling();
    }

    public function  addAccountPersonPhysical($param): void
    {
        try {

            $this->usr->name = $param['name'];
            $this->usr->email = $param['email'];
            $this->usr->passwd = $param['passwd'];
            $this->usr->cep = $param['cep'];
            $this->usr->uf = $param['uf'];
            $this->usr->addres = $param['addres'];
            $this->usr->locality = $param['localidade'];
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