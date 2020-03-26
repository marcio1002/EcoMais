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
        protected $status;

        public function getName() {
            return $this->name;
        }

        public function setName(string $name) {
            if(empty($name)) throw new Exception('Error null values',1);
            $this->name = strtolower(trim($name));
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice(string $price) {
            if(empty($price)) throw new Exception('Error null values',1);
            $this->price = trim($price);
        }
        
        public function getBrand() {
            return $this->brand;
        }
        
        public function setBrand(string $brand) {
            if(empty($brand)) throw new Exception('Error null values',1);
            $this->brand = strtolower(trim($brand));
        }

        public function getMerchant() {
            return $this->merchant;
        }

        public function setMerchant(string $mrt) {
            if(empty($mrt)) throw new Exception('Error null values',1);
            $this->merchant = strtolower(trim($mrt));
        }

        public function getClassification() {
           return $this->category; 
        }

        public function setClassification(string $ctr) {
            if(empty($ctr)) throw new Exception('Error null values',1);
            $this->category = strtolower(trim($ctr));
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
        
        public function setImage( string $exReg,array $file) {
            if($file['error'] === 4) throw new Exception('file undefined',1);
            if($file['error'] === 1) throw new Exception('File size not supported by the system',4);
            if(!preg_match("/\.($exReg)$/",$file['name'])) throw new Exception('Format not support!',5);
            $this->file = $file;
        }

        public function getDescription() {
            return $this->desc;
        }

        public function setDescription(string $desc) {
            if(empty($desc)) throw new Exception('Error null values',1);
            $this->desc = trim($desc);
        }

        public function getPeriod() {
            return $this->pd;
        }

        public function setPeriod(String $pd) {
            if(empty($pd)) throw new Exception('Error null values',1);
            $this->pd = trim($pd);
        }

        public function getStatus() {
           return $this->status; 
        }

        public function setStatus(int $status) {
            $this->status = trim($status);
        }

        public function createAt() {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'd/m/Y(N)-A-H:i:s');
            return $this->date;
        }
    }
?>