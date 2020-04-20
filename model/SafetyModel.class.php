<?php
namespace Model;

    use Model\DataException;
        
    class Safety {

        private $passwd;
        private $imageName;
    
        public function criptPasswd(string $passwd):string 
        {
            $this->passwd = strtoupper(hash("whirlpool",$passwd));
            return $this->passwd;
        }
    
        public function criptImage(string $exReg,string $imageName ):string 
        {
            if(empty($exReg) || empty($imageName)) throw new DataException("Null value");
    
            preg_match("/\.($exReg)$/",$imageName,$ext);
            $this->imageName = md5(uniqid(time())) . "." . $ext[1];
                
            return $this->imageName;
        }
    }
