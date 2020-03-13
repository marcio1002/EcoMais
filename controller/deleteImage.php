<?php    
    require_once "../model/data.class.php";
    try{
        $img = $_POST['img'];
        if(empty($img)) throw new Exception("Value undefined") ;

        $data = new Data('localhost','root','rootadmin','apiTest');

        if($res = $data->delete("images","image = ?",[$img])){
            unlink("../src/uploadImages/$img");
            echo json_encode( ["error" => false,"status"=> 200,"msg" => "Ok"],);
            $data->connectionClose();
        }
        
       
    }catch(PDOException $ex){
       echo json_encode( ["error"=> true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
        die($data->connectionClose());
    }catch(Exception $ex) {
        echo json_encode( ["error" => true,"errCode"=> $ex->getCode(),"msg" => $ex->getMessage()], );
        die($data->connectionClose());
    }
?>