<?php    
    require_once "../model/data.class.php";
    try{
        $img = $_POST['image'];

        $data = new Data('localhost','root','rootadmin','apiTest');
        if($data->delete("images","image = '$img'")){
            
            $data->connectionClose();
            unlink("../src/images/$img");
            echo "<script>confirm('Deletado com sucesso'); location.href = '../view/mostrar.php';</script>";
        }
        
       
    }catch(Exception $ex){
        die($ex->getMessage());
        echo "<script>confirm('Não foi possível deletar a imagem'); location.href = '../view/mostrar.php';</script>";
    }
?>