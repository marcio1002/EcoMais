<?php 
    interface Product {
        public function getName();
        public function setName(string $name);
        public function getPrice();
        public function setPrice(string $price);
        public function getBrand();
        public function setBrand(string $brand);
        public function getManufacturer();
        public function setManufacturer(string $mfr);
        public function getMerchant();
        public function setMerchant(string $mrt);
        public function getCategory();
        public function setCategory(string $category);
        public function getImage();
        public function setImage(string $img);
        public function setDescription(String $desc);
        public function getDescription();
        public function getPeriod();
        public function setPeriod(String $pd);
        public function createAt();
    }
?>