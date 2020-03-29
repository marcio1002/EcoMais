<?php 
    interface ProductInterface {
        public function getName();
        public function setName(string $name);
        public function getPrice();
        public function setPrice(string $price);
        public function getBrand();
        public function setBrand(string $brand);
        public function getMerchant();
        public function setMerchant(string $mrt);
        public function getClassification();
        public function setClassification(string $ctr);
        public function getImage();
        public function setImage(string $ext, array $img);
        public function setDescription(String $desc);
        public function getDescription();
        public function getPeriod();
        public function setPeriod(String $pd);
        public function getStatus();
        public function setStatus(int $status);
        public function createAt();
    }
?>