<?php
 namespace Model;

    use Interfaces\ProductInterface;
    use Exception;

    class Product implements ProductInterface {

        const ACTIVATED = 1;
        const DISABLED = 0;

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
        protected $status = self::ACTIVATED | self::DISABLED;
        

        public function getName():string 
        {
            return $this->name;
        }

        public function setName(string $name):void
        {
            if(empty($name)) throw new DataException('Error null values',1);
            $this->name = trim($name);
        }
        
        public function getPrice():int 
        {
            return $this->price;
        }

        public function setPrice(string $price):void 
        {
            if(empty($price)) throw new DataException('Error null values',1);
            $this->price = trim($price);
        }
        
        public function getBrand():string 
        {
            return $this->brand;
        }
        
        public function setBrand(string $brand):void 
        {
            if(empty($brand)) throw new DataException('Error null values',1);
            $this->brand = trim($brand);
        }

        public function getMerchant():string 
        {
            return $this->merchant;
        }

        public function setMerchant(string $mrt):void 
        {
            if(empty($mrt)) throw new DataException('Error null values',1);
            $this->merchant = trim($mrt);
        }

        public function getClassification():string 
        {
           return $this->category; 
        }

        public function setClassification(string $ctr):void 
        {
            if(empty($ctr)) throw new DataException('Error null values',1);
            $this->category = trim($ctr);
        }
        
        public function getImage():array 
        {
            return $this->file;
        }

        /**
         * separar os tipos de extensão por barra vertical
         * exem: ext| ext| ext;
         * @param string $ext  o tipo de formato para validação  
         * @param array $file  o arquivo
        */
        public function setImage( string $exReg,array $file):void 
        {
            if($file['error'] === 4) throw new DataException('file undefined',1);
            if($file['error'] === 1) throw new DataException('File size not supported by the system',4);
            if(!preg_match("/\.($exReg)$/",$file['name'])) throw new DataException('Format not support!',5);
            $this->file = $file;
        }

        public function getDescription():string 
        {
            return $this->desc;
        }

        public function setDescription(string $desc):void 
        {
            if(empty($desc)) throw new DataException('Error null values',1);
            $this->desc = trim($desc);
        }

        public function getPeriod():string 
        {
            return $this->pd;
        }

        public function setPeriod(string $pd):void 
        {
            if(empty($pd)) throw new Exception('Error null values',1);
            $this->pd = trim($pd);
        }

        public function getStatus():int
        {
            return $this->status;
        }

        public function setStatus(int $status):void
        {
            $this->status = $status;
        }

        public function createAt():string 
        {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'Y/m/d-(N)-A%H:i');
            return $this->date;
        }
    }
    