<?php
    require_once "../interfaces/productInterface.php";
    class Product implements ProductInterface {
        protected $name;
        protected $price;
        protected $brand;
        protected $manufacturer;
        protected $merchant;
        protected $category;
        protected $img;
        protected $date;
        protected $desc;
        protected $pd;

        public function getName() {
            return $this->name;
        }

        public function setName(string $name) {
            if(!isset($name)) throw new Exception('Undefined value');
            $this->name = $name;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice(string $price) {
            if(!isset($price)) throw new Exception('Undefined value');
            $this->price = $price;
        }
        
        public function getBrand() {
            return $this->brand;
        }
        
        public function setBrand(string $brand) {
            if(!isset($brand)) throw new Exception('Undefined value');
            $this->brand = $brand;
        }
        
        public function getManufacturer() {
            return $this->manufacturer;
        }
        
        public function setManufacturer(string $mfr) {
            if(!isset($manufacturer)) throw new Exception('Undefined value');
           return $this->manufacturer = $mfr;
        }

        public function getMerchant() {
            return $this->merchant;
        }

        public function setMerchant(string $mrt) {
            if(!isset($mrt)) throw new Exception('Undefined value');
            $this->merchant = $mrt;
        }

        public function getCategory() {
           return $this->category; 
        }

        public function setCategory(string $ctr) {
            if(!isset($ctr)) throw new Exception('Undefined value');
            $this->category = $ctr;
        }
        
        public function getImage() {
            return $this->img;
        }
        /**
         * @param array $ext o tipo de formato para validação  
         * 
         * @param string  $Img o arquivo
         * 
         * separar por barra vertical
         * exem: ext| ext| ext;
        */
        public function setImage( string $ext = "",array $img) {
            if($img['error'] === 4) throw new Exception('file undefined');
            if($img['error'] === 1) throw new Exception('File size not supported by the system');
            if(!preg_match("/\.($ext$)/",$img['name'],$ex)) throw new Exception('Format not support!');
            $this->img = $img;
        }

        public function getDescription() {
            return $this->desc;
        }

        public function setDescription(string $desc) {
            if(!isset($desc)) throw new Exception('Undefined value');
            $this->desc = $desc;
        }

        public function getPeriod() {
            return $this->pd;
        }

        public function setPeriod(String $pd) {
            if(!isset($pd)) throw new Exception('Undefined value');
            $this->pd = $pd;
        }

        public function createAt() {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }
?>