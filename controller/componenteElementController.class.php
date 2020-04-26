<?php

namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Service\Data;
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
      echo "<table id='info_users table'>
            <thead>
              <tr class='tr'>
                  <th class='th'>Nome</th>
                  <th class='th'>Email</th>
                  <th class='th'>Senha</th>
                  <th class='th'>Data e hora</th>
              </tr>
            </thead>
            <tbody>
            ";
      if (count($res,COUNT_RECURSIVE) > 5 && is_array($res)) {
        foreach ($res as $array_res) {
          echo "   
                <tr class='tr'>
                  <td class='td'><input type='text' value='$array_res[nome]' name='name' class='infoUser' /></td>
                  <td class='td'><input type='text' value='$array_res[email]' name='email' class='infoUser'/></td>
                  <td class='td'><input type='text' value='$array_res[password]' name='passwd' class='infoUser'/></td>
                  <td class='td'><input type='text' value='$array_res[date]' name='date' disabled/></td>
                  <input type='hidden' value='$array_res[id_usuario]' name='id'/>
                  <td class='td'><input type='button' id='btnUpdate' value='Atualizar'/></td> 
                  <td class='td'><input type='button' id='btndelete' value='Deletar'/></td> 
                </tr>
               ";
        }
      } else {
        echo "   
                <tr class='tr'>
                  <td class='td'><input type='text' value='$res[nome]' name='name' class='infoUser' /></td>
                  <td class='td'><input type='text' value='$res[email]' name='email' class='infoUser'/></td>
                  <td class='td'><input type='text' value='$res[password]' name='passwd' class='infoUser'/></td>
                  <td><input type='text' value='$res[date]' name='date' disabled/></td>
                  <input type='hidden' value='$res[id_usuario]' name='id'/>
                  <td class='td'><input type='button' id='btnUpdate' value='Atualizar'/></td> 
                  <td class='td'><input type='button' id='btndelete' value='Deletar'/></td> 
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
