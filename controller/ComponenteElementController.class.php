<?php
namespace Controller;

  require_once __DIR__."/../vendor/autoload.php";
  
  use Server\Data;
  use Exception;
  use PDOException;

 class ComponenteElement {
  public function showRegistry()
    {
      try {
        $sql = new Data();
        $sql->open();
        $res =  $sql->show("usuarios");
        if(empty($res) || !is_array($res)) return;
            echo "<table>
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
            if(count($res,COUNT_RECURSIVE) > 5){
              foreach ($res as $array_res) {
                $date = $array_res['date'];
                echo "   
                <tr>
                  <td><input type='text' value='$array_res[nome]' name='name' class='infoUser' /></td>
                  <td><input type='text' value='$array_res[email]' name='email' class='infoUser'/></td>
                  <td><input type='text' value='$array_res[password]' name='passwd' class='infoUser'/></td>
                  <td><input type='text' value='$date' name='date' disabled/></td>
                  <input type='hidden' value='$array_res[id_usuario]' name='id'/>
                  <td><input type='button' id='btnUpdate' value='Atualizar'/></td> 
                  <td><input type='button' id='btndelete' value='Deletar'/></td> 
                </tr>
                </form>
                      ";
                }
            }else {
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
          $sql->close();
      } catch (PDOException $ex) {
        die($ex->getMessage());
      }catch(Exception $ex) {
        die($ex->getMessage());
      }
  }
  
 public function showImage()
  {
    try {
      $sql = new Data();
      $sql->open();
      $res = $sql->show('images',[],"ORDER BY image ASC",[],2);
      if(empty($res) || !is_array($res)) return;
      echo "<div id='box'>";
        if(count($res,COUNT_RECURSIVE) > 2){
          foreach ($res as $array_res) {
            echo "
            <div id='boxImg'>
                <div id='boxBtnDelete'>
                  <p id='btnDelete'>
                    <input type='hidden'  name='image' value='$array_res[image]'/>
                    <button type='button' id='btnDltImage' title='Deletar imagem'><img src='../src/svgs/delete-circle.svg'/></button>
                  </p>
                </div>
              <img src='../src/uploadImages/$array_res[image]' id='plan'/>
            </div>
            ";
          }
        }else {
          echo "
          <div id='boxImg'>
              <div id='boxBtnDelete'>
                <p id='btnDelete'>
                  <input type='hidden'  name='image' value='$res[image]'/>
                  <button type='button' id='btnDltImage' title='Deletar imagem'><img src='../src/svgs/delete-circle.svg'/></button>
                </p>
              </div>
            <img src='../src/uploadImages/$res[image]' id='plan'/>
          </div>
          ";
        }
      echo "</div>";
        $sql->close(); 
      
    } catch (PDOException $ex) {
      die($ex->getMessage());
    }catch(Exception $ex) {
      die($ex->getMessage());
    }
  }
  
 }
