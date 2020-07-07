<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;

class Safety
{

    private string $passwd;
    private string $imageName;
    private string $key;

    /**
     * Criptografia Whirlpool
     * @param string $passwd
     * @return string
     */
    public function criptPasswd(string $passwd): string
    {
        $this->passwd = strtoupper(hash("whirlpool", imap_binary($passwd)));
        return $this->passwd;
    }

    /**
     * Criptografia MD5
     * @param string $exReg
     * @param string $imageName
     * @return string
     */
    public function criptImage(string $exReg, string $imageName): string
    {
        if (empty($exReg) || empty($imageName)) throw new DataException("Null value");

        preg_match("/\.($exReg)$/", $imageName, $ext);
        $this->imageName = md5(uniqid(time($imageName))) . "." . $ext[1];

        return $this->imageName;
    }

    /**
     * Cria um token de 8 bits
     * @param string $string
     */

    public function createToken(string $param): string
    {
        $numberRandom = random_int(100,1999);
        $this->key =  hash("sha512", uniqid(imap_binary($param)) . $numberRandom);

        return $this->key;
    }

    public function isEmail($param): bool
    {
       return (preg_match("/^(.)+\@[a-zA-Z]+\.[a-zA-Z]+$/i",$param)) ? true : false;
    }
}
