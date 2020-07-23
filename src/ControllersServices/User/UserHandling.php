<?php

namespace Ecomais\ControllersServices\User;

use Ecomais\Models\DataException;
use Ecomais\Models\Person;
use Ecomais\Services\Data;
use PDO;

class UserHandling {

  private Data $sql;


    public function __construct() {
      $this->sql = new Data();
    }

  public function userInfo(Person $user): ?array
  {
    try{

      $this->sql->open();

     return $this->sql
        ->show("usuario","","statusconta = true AND id_usuario = ?",3)
        ->prepareParam([$user->id],[PDO::PARAM_INT])
        ->executeSql();
    }catch(DataException $ex) {

    }finally {
      $this->sql->close();
    }
  }

} 