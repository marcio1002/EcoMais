<?php
    require_once "../interfaces/productInterface.php";
    class ProductController implements Product {
        private $name;
        private $price;
        private $brand;
        private $manufacturer;
        private $merchant;
        private $category;
        private $img;
        private $date;

        public function getName() {
            return $this->name;
        }

        public function setName(string $name) {
            $this->name = $name;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice(string $price) {
            $this->price = $price;
        }
        
        public function getBrand() {
            return $this->brand;
        }
        
        public function setBrand(string $brand) {
            $this->brand = $brand;
        }
        
        public function getManufacturer() {
            return $this->manufacturer;
        }
        
        public function setManufacturer(string $mfr) {
           return $this->manufacturer = $mfr;
        }

        public function getMerchant() {
            return $this->merchant;
        }

        public function setMerchant(string $mrt) {
            $this->merchant = $mrt;
        }

        public function getCategory() {
           return $this->category; 
        }

        public function setCategory(string $category) {
            $this->category = $category;
        }
        
        public function getImage() {
            return $this->img;
        }

        public function setImage(string $img) {
            $this->img = $img;
        }

        public function createAt() {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }

    $product = new ProductController();

    $product->createAt();
?>