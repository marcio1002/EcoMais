<?php

namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Server\Data;
use Model\DataException;

class ComponenteElement
{
  public function showRegistry()
  {
    try {
      $sql = new Data();
      $sql->open();
      $res =  $sql->show("usuarios");
      if (empty($res) || !is_array($res)) return;
      echo "<table id='infor_users'>
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Senha</th>
                  <th>Data e hora</th>
              </tr>
            </thead>
            <tbody>
            ";
      if (count($res,COUNT_RECURSIVE) > 5 && is_array($res)) {
        foreach ($res as $array_res) {
          echo "   
                <tr>
                  <td><input type='text' value='$array_res[nome]' name='name' class='infoUser' /></td>
                  <td><input type='text' value='$array_res[email]' name='email' class='infoUser'/></td>
                  <td><input type='text' value='$array_res[password]' name='passwd' class='infoUser'/></td>
                  <td><input type='text' value='$array_res[date]' name='date' disabled/></td>
                  <input type='hidden' value='$array_res[id_usuario]' name='id'/>
                  <td><input type='button' id='btnUpdate' value='Atualizar'/></td> 
                  <td><input type='button' id='btndelete' value='Deletar'/></td> 
                </tr>
               ";
        }
      } else {
        echo "   
                <tr>
                  <td><input type='text' value='$res[nome]' name='name' class='infoUser' /></td>
                  <td><input type='text' value='$res[email]' name='email' class='infoUser'/></td>
                  <td><input type='text' value='$res[password]' name='passwd' class='infoUser'/></td>
                  <td><input type='text' value='$res[date]' name='date' disabled/></td>
                  <input type='hidden' value='$res[id_usuario]' name='id'/>
                  <td><input type='button' id='btnUpdate' value='Atualizar'/></td> 
                  <td><input type='button' id='btndelete' value='Deletar'/></td> 
                </tr>
                </form>";
      }
      echo "</tbody>
    </table>";
    } catch (DataException $ex) 
    {
      die($ex->getMessage());
    }
    finally
    {
      $sql->close();
    }
  }

  public function showImage()
  {
    try {

    } catch (DataException $ex) {

    } 
  }
}
