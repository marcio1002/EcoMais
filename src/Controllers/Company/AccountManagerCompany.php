<?php

namespace Ecomais\Controllers\Company;

use Ecomais\ControllersServices\Company\CompanyHandling;
use Ecomais\Models\DataException;

class AccountManagerCompany {
    //--- Api Pagamento ---
    private CompanyHandling $handling;

    public function __construct()
    {
        $this->handling = new CompanyHandling();
    }

    public function listenCompanyPro(): void
    {
        try{
            if($row = $this->handling->listenCompanyPro())
                echo json_encode(["error" => false, "status" => 200, "data" => $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    

    public function listenCompany(): void
    {
        try{
            if($row = $this->handling->listenCompany())
                echo json_encode(["error" => false, "status" => 200, "data" => $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }
}