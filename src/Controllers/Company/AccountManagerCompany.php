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
        "MG" => "minas gerais",
        "PA" => "pará",
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
    private CompanyHandling $account;
    private PersonLegal $emp;
    private Implementation $implement;

    public function __construct()
    {
        $this->emp = new PersonLegal();
        $this->account = new CompanyHandling();
        $this->implement = new Implementation();
    }

    public function  createAccount($params): void
    {
        try {
            $this->emp->fantasy = filter_var($params['fantasy'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->reason = filter_var($params['reason'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cnpj =  preg_replace("/\D/", "", filter_var($params['cnpj'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL));
            $this->emp->email = filter_var($params['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->contact = preg_replace("/\D/", "", filter_var($params['contact'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL));
            $this->emp->passwd = filter_var($params['passwd'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->typePackage = filter_var($params['plano'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->cep = filter_var($params['cep'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->uf = filter_var($params['uf'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->address = filter_var($params['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->locality = filter_var($params['locality'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
            $this->emp->statusAccount = PersonLegal::ENABLED;
            $this->emp->createAt();

            if ($this->account->createAccountPersonLegal($this->emp)) {
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            } else {
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]);
            }
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function findAll(): void
    {
        try {
            if ($row = $this->account->findAll())
                echo json_encode(["error" => false, "status" => 200, "data" => $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function findById(int $id): ?array
    {
        try {
            $this->emp->id = $id;

            return $this->account->findById($this->emp) ?? null;

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function findByIdJSON(array $params): void
    {
        try {
            $this->emp->id = $params["id"];

            if ($row = $this->account->findById($this->emp))
                echo json_encode(["error" => false, "status" => 200, "data" => $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function listenCompanyPro(): void
    {
        try {
            if ($row = $this->account->listenCompanyPro())
                echo json_encode(["error" => false, "status" => 200, "data" => empty($row[0]) ? [$row] : $row]);
            else
                echo json_encode(["error" => true, "status" => 404, "msg" => "Not results"]);
        
        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()}  server error");
        }
    }

    public function listenInfoCompany(int $id): ?array
    {
        try {
            $this->emp->id = $id;

            return  $this->account->listenInfoCompany($this->emp) ?? null;

        } catch (DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function updateInfoCompany($params): void
    {
        try{
            foreach($params as $k => $v) $this->emp->$k = $v;

            if ($this->account->updateInfoCompany($this->emp)) 
                echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "msg" => "Ok"]);
            else 
                echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "msg" => "Not Imprements"]); 

        }catch(DataException $ex){
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function updateImageCompany($params): void
    {
        try{
            $upload = new Send("src/uploads","imageCompany",static::$type,static::$extension,false);
            
            if(isset($_FILES["image"]) || $upload::isAllowed()) {

                $bitType = array("bytes","KB","MB","GB");
                $bytes = filesize($_FILES["image"]['tmp_name']);
                $factor = floor(log($bytes) / log(1024));
                $maxFileSize = 17000000;

                if($bytes >= $maxFileSize && $bitType[$factor] == $bitType[2]) exit(json_encode(["error" => true, "status" => DataException::NOT_IMPLEMENTED, "msg" => "Not Implements"]));

                $newFileName =  explode(".",$this->implement->criptImage($_FILES["image"]))[0];
                $this->emp->id = $params['id'];

                $row = $this->account->findById($this->emp);
                
                //imagem é apagada porque o nome sempre é diferente
                if(file_exists($row["imagem"])) unlink($row["imagem"]);
                    
                $this->emp->image =  $upload->upload($_FILES['image'],$newFileName);

                if ($this->account->updateImageCompany($this->emp)) {
                    $row = $this->implement->toObject($this->account->findById($this->emp));
                    echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "data" => $row]);
                } 
                 else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "data" => []]);
            }else {
                echo json_encode(["error" => true, "status" => DataException::NOT_IMPLEMENTED, "msg" => "Not Implements"]);

            }
            
        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

    public function searchCompany($params): void
    {
        try {
            foreach ($params as $k => $v) {
                if(!in_array(strtolower($v),static::$locality))  continue;
                if($k == "uf") 
                  $this->emp->$k =  array_search(strtolower($v),static::$locality);
                else 
                    $this->emp->$k = $v;
            }

            if ($row = $this->account->searchCompany($this->emp)) 
                    echo json_encode(["error" => false, "status" => DataException::NOT_CONTENT, "data" => is_array($row)? $row : [$row] ]);
                 else 
                    echo json_encode(["error" => true, "status" => DataException::NOT_FOUND, "data" => []]);

        }catch(DataException $ex) {
            header("{$_SERVER["SERVER_PROTOCOL"]} {$ex->getCode()} server error");
        }
    }

}
