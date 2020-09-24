<?php

namespace Ecomais\ControllersServices\User;

use Ecomais\Models\DataException;
use Ecomais\Models\Implementation;
use Ecomais\Models\Person;
use Ecomais\Services\Data;
use PDO;

class UserHandling
{

  private Data $sql;
  private Implementation $implement;


  public function __construct()
  {
    $this->sql = new Data();
    $this->implement = new Implementation();
  }

  public function createAccountPersonPhysical(Person $person): bool
  {
    try {
      $person->passwd =  $this->implement->criptPasswd($person->passwd);
      $columns = "nome,email,senha,uf,cidade,endereco,cep,statusconta,data_criacao";

      $this->sql->open();

      return $this->sql
        ->add("usuario", $columns, count($person->toArray()))
        ->prepareParam($person->toArray())
        ->execNotRowSql();
    } catch (DataException $ex) {
      throw new DataException($ex->getMessage(), $ex->getCode());
    } finally {
      $this->sql->close();
    }
  }
  public function findById(Person $user): ?array
  {
    try {

      $this->sql->open();

      return $this->sql
        ->show("usuario", "", "statusconta = true AND id_usuario = ?", 3)
        ->prepareParam([$user->id], [PDO::PARAM_INT])
        ->executeSql();
    } catch (DataException $ex) {
    } finally {
      $this->sql->close();
    }
  }
}
