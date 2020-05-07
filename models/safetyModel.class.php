<?php
namespace Models;

    use Models\DataException;
        
    class Safety {

        private $passwd;
        private $imageName;
    
        /**
         * Criptografia Whirlpool
         * @param string $passwd
         * @return string
         */
        public function criptPasswd(string $passwd):string 
        {
            $this->passwd = strtoupper(hash("whirlpool",$passwd));
            return $this->passwd;
        }

        /**
         * Criptografia MD5
         * @param string $exReg
         * @param string $imageName
         * @return string
         */
        public function criptImage(string $exReg,string $imageName ):string 
        {
            if(empty($exReg) || empty($imageName)) throw new DataException("Null value");
    
            preg_match("/\.($exReg)$/",$imageName,$ext);
            $this->imageName = md5(uniqid(time())) . "." . $ext[1];
                
            return $this->imageName;
        }
    }
