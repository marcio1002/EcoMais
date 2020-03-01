<?php
    require_once "connection.php";
    
    $img = $_POST['image'];

    try{
        if($data->delete("images","image = '$img'")){
            
            $data->connectionClose();
            unlink("../src/images/$img");
            echo "<script>confirm('Deletado com sucesso'); location.href = '../view/mostrar.php';</script>";
        }
        
       
    }catch(Exception $ex){
        echo "<script>confirm('Não foi possível deletar a imagem'); location.href = '../view/mostrar.php';</script>";
        die($ex->getMessage());
    }
?>