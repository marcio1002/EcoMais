<?php

namespace Ecomais\Controllers\Company;


use Ecomais\Models\{DataException,Safety};
use Ecomais\ControllersServices\CompanyHandling;
use Ecomais\Models\PersonLegal;

class AccountManagerCompany {
    private CompanyHandling $Company;
    private PersonLegal $emp;
    private Safety $safety;

    function __Construct() 
    {
        $this->emp = new PersonLegal();
        $this->Company = new CompanyHandling();
        $this->safety = new Safety();
    }

    public function  createAccount($param): void
    {
        try {
            $this->emp->fantasy = filter_var($param['fantasia'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->reason = filter_var($param['razao'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cnpj = filter_var($param['cnpj'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->email = filter_var($param['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->passwd = filter_var($param['passwd'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->typePackage = filter_var($param['plano'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cep = filter_var($param['cep'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->uf = filter_var($param['uf'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->addres = filter_var($param['addres'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->locality = filter_var($param['locality'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->statusAccount = PersonLegal::ENABLED;
            $this->emp->createAt();

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