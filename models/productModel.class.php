<?php
 namespace Models;

    use Interfaces\ProductInterface;
    use Models\DataException;

    class Product implements ProductInterface {

        const ACTIVATED = 1;
        const DISABLED = 0;

        protected $id;
        protected $name;
        protected $price;
        protected $brand;
        protected $manufacturer;
        protected $merchant;
        protected $clt;
        protected $file;
        protected $date;
        protected $desc;
        protected $pd;
        protected $quant;
        protected $fkCompany;
        protected $status = self::ACTIVATED | self::DISABLED;
        

        public function getId(): int
        {
            return $this->id;
        }


        public function setId(int $id): void
        {
            if(empty($id)) throw new DataException('Null values',DataException::REQ_INVALID);

            $this->id = $id;
        }

        public function getName():string 
        {
            return $this->name;
        }

        public function setName(string $name):void
        {
            if(empty($name)) throw new DataException('Null values',DataException::REQ_INVALID);
           
            $this->name = trim($name);
        }
        
        public function getPrice():float 
        {
            return $this->price;
        }

        public function setPrice(float $price):void 
        {
            if(empty($price)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->price = trim($price);
        }
        
        public function getBrand():string 
        {
            return $this->brand;
        }
        
        public function setBrand(string $brand):void 
        {
            if(empty($brand)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->brand = trim($brand);
        }

        public function getQuantity():int
        {
            return $this->quant;
        }

        public function setQuantity(int $quantity):void
        {
            if(empty($quantity)) throw new DataException('Null values',DataException::REQ_INVALID);
            
            $this->quant = trim($quantity);
        }

        public function getClassification():string 
        {
           return $this->category; 
        }

        public function setClassification(string $clt):void 
        {
            if(empty($clt)) throw new DataException('Null values',DataException::REQ_INVALID);
            $this->clt = trim($clt);
        }
        
        public function getDescription():string 
        {
            return $this->desc;
        }

        public function setDescription(string $desc):void 
        {
            if(empty($desc)) throw new DataException('Null values',DataException::REQ_INVALID);
            $this->desc = trim($desc);
        }

        public function getPeriod():string 
        {
            return $this->pd;
        }

        public function setPeriod(string $pd):void 
        {
            if(empty($pd)) throw new DataException('Null values',DataException::REQ_INVALID);
            $this->pd = trim($pd);
        }

        public function getStatus():int
        {
            return $this->status;
        }

        public function setStatus(int $status):void
        {
            if(empty($status)) throw new DataException('Null values',DataException::REQ_INVALID);

            $this->status = trim($status);
        }

        public function getFk_Company():int
        {
            return $this->fkCompany;
        }

        public function setFk_Company(int $fkCompany):void
        {
            if(empty($fkCompany)) throw new DataException('Null values',DataException::REQ_INVALID);

            $this->fkCompany = trim($fkCompany);   
        }

        public function createAt():string
        {
            date_default_timezone_set("America/Sao_paulo");
            $this->date =   date( 'Y-m-d(N)A%H:i:s');
            return $this->date;
        }
    }
    