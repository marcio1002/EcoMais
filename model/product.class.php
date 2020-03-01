<?php
    require_once "../interfaces/productInterface.php";
    class Product implements ProductInterface {
        protected $name;
        protected $price;
        protected $brand;
        protected $manufacturer;
        protected $merchant;
        protected $category;
        protected $file;
        protected $date;
        protected $desc;
        protected $pd;

        public function getName() {
            return $this->name;
        }

        public function setName(string $name) {
            if(empty($name)) throw new Exception('Undefined value');
            $this->name = $name;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice(string $price) {
            if(empty($price)) throw new Exception('Undefined value');
            $this->price = $price;
        }
        
        public function getBrand() {
            return $this->brand;
        }
        
        public function setBrand(string $brand) {
            if(empty($brand)) throw new Exception('Undefined value');
            $this->brand = $brand;
        }
        
        public function getManufacturer() {
            return $this->manufacturer;
        }
        
        public function setManufacturer(string $mfr) {
            if(empty($manufacturer)) throw new Exception('Undefined value');
           return $this->manufacturer = $mfr;
        }

        public function getMerchant() {
            return $this->merchant;
        }

        public function setMerchant(string $mrt) {
            if(empty($mrt)) throw new Exception('Undefined value');
            $this->merchant = $mrt;
        }

        public function getCategory() {
           return $this->category; 
        }

        public function setCategory(string $ctr) {
            if(empty($ctr)) throw new Exception('Undefined value');
            $this->category = $ctr;
        }
        
        public function getImage() {
            return $this->file;
        }
        /**
         * @param string $ext -> o tipo de formato para validação  
         * @param array $file -> o arquivo
         * separar por barra vertical
         * exem: ext| ext| ext;
        */
        
        public function setImage( string $ext,array $file) {
            if($file['error'] === 4) throw new Exception('file undefined');
            if($file['error'] === 1) throw new Exception('File size not supported by the system');
            if(!preg_match("/\.($ext$)/",$file['name'],$ex)) throw new Exception('Format not support!');
            $this->file = $file;
        }

        public function getDescription() {
            return $this->desc;
        }

        public function setDescription(string $desc) {
            if(empty($desc)) throw new Exception('Undefined value');
            $this->desc = $desc;
        }

        public function getPeriod() {
            return $this->pd;
        }

        public function setPeriod(String $pd) {
            if(empty($pd)) throw new Exception('Undefined value');
            $this->pd = $pd;
        }

        public function createAt() {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }
?>