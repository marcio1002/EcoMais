<?php    
namespace Controller;

    require_once __DIR__."/../vendor/autoload.php";
        
        use Server\Data;
        use Exception;
        use PDOException;

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
