<?php    
    require_once "../model/data.class.php";
    try{
        $img = $_POST['image'];

        $data = new Data('localhost','root','rootadmin','apiTest');
        if($data->delete("images","image = ?",array($img))){
            $data->connectionClose();
            unlink("../src/uploadImages/$img");
            return "ok";
        }
        
       
    }catch(PDOException $ex){
        return die($ex->getMessage());
    }catch(Exception $ex) {
        return die($ex->getMessage());
    }
?>