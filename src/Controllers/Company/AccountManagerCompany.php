<?php

namespace Ecomais\Controllers\Company;

use CoffeeCode\Uploader\Send;
use Ecomais\Models\{DataException, Implementation, PersonLegal};
use Ecomais\ControllersServices\Company\CompanyHandling;

class AccountManagerCompany
{
    private static $type = array(
        "image/jpg",
        "image/jpeg",
        "image/png",
        "image/wbmp",
        "image/gif",
        "image/tiff",
        "image/psd",
        "image/jpc",
        "image/jp2",
        "image/jpx",
    );
    private static $extension = array (
        "jpg",
        "jpeg",
        "png",
        "wbmp",
        "gif",
        "tiff",
        "psd",
        "jpc",
        "jp2",
        "jpx",
    );
    private static $locality = array(
        "AC" => "acre",
        "AL" => "alagoas",
        "AP" => "amapá",
        "AM" => "amazonas",
        "BA" => "bahia",
        "CE" => "ceara",
        "DF" => "distrito federal",
        "ES" => "espírito santo",
        "GO" => "goias",
        "MA" => "maranhão",
        "MS" => "mato grosso do sul",
        "MG" =>"mina gerais",
        "PA" => "para",
        "PB" => "paraiba",
        "PR" => "parana",
        "PE" => "pernambuco",
        "PI" => "piauí",
        "RJ" => "rio de janeiro",
        "RN" => "rio grande do norte",
        "RS" => "rio grande do sul",
        "RO" => "rondônia",
        "rr" => "roraima",
        "SC" => "santa catarina",
        "SP" => "são paulo",
        "SE" => "sergipe",
        "TO" => "tocantins"
    );
    private CompanyHandling $handling;
    private PersonLegal $emp;
    private Implementation $implement;

    public function __construct()
    {
        $this->emp = new PersonLegal();
        $this->handling = new CompanyHandling();
        $this->implement = new Implementation();
    }

    public function  createAccount($param): void
    {
        try {
            $this->emp->fantasy = filter_var($param['fantasy'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->reason = filter_var($param['reason'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cnpj =  preg_replace("/\D/", "", filter_var($param['cnpj'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL));
            $this->emp->email = filter_var($param['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->contact = preg_replace("/\D/", "", filter_var($param['contact'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL));
            $this->emp->passwd = filter_var($param['passwd'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->typePackage = filter_var($param['plano'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cep = filter_var($param['cep'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->uf = filter_var($param['uf'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->address = filter_var($param['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->locality = filter_var($param['locality'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->statusAccount = PersonLegal::ENABLED;
            $this->emp->createAt();

            if ($this->handling->createAccountPersonLegal($this->emp)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function listenCompanyPro(): void
    {
        try {
            if ($row = $this->handling->listenCompanyPro())
                echo json_encode(["error" => false, "status" => 200, "data" => empty($row[0]) ? [$row] : $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function listenCompany(): void
    {
        try {
            if ($row = $this->handling->listenCompany())
                echo json_encode(["error" => false, "status" => 200, "data" => $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function listenInfoCompany(int $id): ?array
    {
        try {
            $this->emp->id = $id;

            return  ($row = $this->handling->listenInfoCompany($this->emp)) ? $row : null;

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function updateInfoCompany($param): void
    {
        try{
            foreach($param as $k => $v) $this->emp->$k = $v;

            if ($this->handling->updateInfoCompany($this->emp)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }

        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function updateImageCompany($param): void
    {
        try{
            $upload = new Send("src/uploads","imageCompany",static::$type,static::$extension,false);
            
            if(isset($_FILES["image"]) && $upload::isAllowed()) {

                $bitType = array("bytes","KB","MB","GB");
                $bytes = filesize($_FILES["image"]['tmp_name']);
                $factor = floor(log($bytes) / log(1024));
                $maxFileSize = 17000000;

                if($bytes >= $maxFileSize && $bitType[$factor] == $bitType[2]) exit(json_encode(["error" => true, "status" => DataException::NOT_IMPLEMENTED, "msg" => "Not Implements"]));

                $newFileName =  explode(".",$this->implement->criptImage($_FILES["image"]))[0];
                $this->emp->id = $param['id'];

                $row = $this->handling->userCompanyInfo($this->emp);
                
                //imagem é apagada porque o nome sempre é diferente
                if(file_exists($row["imagem"])) unlink($row["imagem"]);
                    
                $this->emp->image =  $upload->upload($_FILES['image'],$newFileName);

                if ($this->handling->updateImageCompany($this->emp)) 
                    echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
                 else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Implements"]);
            }else {
                echo json_encode(["error" => true, "status" => DataException::NOT_IMPLEMENTED, "msg" => "Not Implements"]);

            }
            
        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function searchCompany($param): void
    {
        try {

            foreach ($param as $k => $v) {
                if($k == "uf") {
                    foreach(static::$locality as $prefix => $locality) {
                        if($locality == $v) $this->emp->$k = $prefix;
                    }
                }else {
                    $this->emp->$k = $v;
                }
            }

            if ($row = $this->handling->searchCompany($this->emp)) 
                    echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "data" => is_array($row)? $row : [$row] ]);
                 else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "data" => []]);

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

}
