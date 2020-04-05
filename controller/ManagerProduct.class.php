<?php    
namespace Controller;

    require_once __DIR__."/../vendor/autoload.php";
        
        use Model\{Product,Safety};
        use Server\Data;
        use Exception;
        use PDOException;

    class ManagerProduct {
        
        public function deleteImage() 
        {

            try{
                $data = new Data();
                
                $img = $_POST['img'];
                if(empty($img)) throw new Exception("Value undefined") ;
        
        
                $data->open();
        
                if($data->delete("images","image = ?",[$img])){
                    $data->close();
                    unlink("../src/uploadImages/$img");
                    echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
                }
                
            }catch(PDOException $ex){
               echo json_encode( ["error"=> true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
                die();
            }catch(Exception $ex) {
                echo json_encode( ["error" => true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
                die();
            }
        }

//função não será usada na produção.
        public function insertIMage() 
        {
            try {
                $data = new Data();
                $prod = new Product();
                $safety = new Safety();
      
                $width = 2200;
                $height = 2215;
                $byte = 2000000;
      
                $prod->setImage("jpg|png|jpeg|bmp", $_FILES['img']);
                $img = $prod->getImage();
                $imgInfoSize = getimagesize($img['tmp_name']);
      
                if (($imgInfoSize[0] > $width)|| ($imgInfoSize[1] > $height) || ($img['size'] > $byte)) throw new Exception('maximum size exceeded',4);
      
                $tokenName = $safety->criptImage("jpg|png|jpeg|bmp",$img['name']);
      
                if (move_uploaded_file($img['tmp_name'], "../src/uploadImages/$tokenName")) {
                     $data->open();
                     $data->add("images", ["image"], [$tokenName]);
                     $data->close();
                     echo "<script>confirm('Imagem salva com sucesso'); location.href = '../view/image.php';</script>";
                }
           } catch (PDOException $ex) {
                die($ex->getMessage());
           }catch(Exception $ex) {
                die($ex->getMessage());
           }
        }
       public function activeImage() 
        {

        }
    }
