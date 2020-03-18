<?php
require_once "../model/dataModel.class.php";
require_once "../model/productModel.class.php";

try {
     $data = new Data('localhost','root','rootadmin','apiTest');
     $prod = new Product();

     $width = 2200;
     $height = 2215;
     $byte = 2000000;

     $prod->setImage("jpg|png|jpeg|bmp", $_FILES['img']);
     $img = $prod->getImage();
     $imgInfoSize = getimagesize($img['tmp_name']);

     if (($imgInfoSize[0] > $width)|| ($imgInfoSize[1] > $height) || ($img['size'] > $byte)) throw new Exception('maximum size exceeded',4);

     preg_match("/\.(jpg|png|jpeg|bmp)$/", $img['name'], $ext);

     $tokenName = md5(uniqid(time())) . "." . $ext[1];

     if (move_uploaded_file($img['tmp_name'], "../src/uploadImages/$tokenName")) {

          $data->add("images", ["image"], [$tokenName]);
          echo "<script>confirm('Imagem salva com sucesso'); location.href = '../view/image.php';</script>";
     }
} catch (PDOException $ex) {
     die($ex->getMessage());
}catch(Exception $ex) {
     die($ex->getMessage());
}
?>