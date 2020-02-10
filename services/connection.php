<?php 
    $server = "localhost:3306";
    $user = "root";
    $password = "";
    $database = "apiTest";

    $connection = mysqli_connect($server,$user,$password,$database) or die("<script>confirm('⛔ Erro ao conectar com o banco,".mysqli_connect_errno()."'); location.href = index.php </script>");

?>