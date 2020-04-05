<?php
namespace Model;

    use FFI\Exception;
        
    class Safety {

        private $passwd;
        private $imageName;
    
        public function criptPasswd(string $passwd) {
            $this->passwd = strtoupper(hash("whirlpool",$passwd));
            return $this->passwd;
        }
    
        public function criptImage(string $exReg,string $imageName ) {
            if(empty($exReg) || empty($imageName)) throw new Exception("Null value");
    
            preg_match("/\.($exReg)$/",$imageName,$ext);
            $this->imageName = md5(uniqid(time())) . "." . $ext[1];
                
            return $this->imageName;
        }
    }
