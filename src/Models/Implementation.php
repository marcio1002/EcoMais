<?php
namespace Ecomais\Models;

use Ecomais\Models\DataException;
use Ecomais\Services\Data;

class Implementation
{

    private string $passwd;
    private string $imageName;
    private string $key;
    private Data $sql;

    public function __construct() 
    {
        $this->sql = new Data();
    }

    /**
     * Criptografia Bcrypt
     * @param string $passwd
     * senha 
     * @return string 
     * Retorna uma nova criptografia
     */
    public function criptPasswd(string $passwd): string
    {
        if (empty($passwd)) throw new DataException("Null value",DataException::NOT_ACCEPTABLE);

        $this->passwd =  password_hash($passwd, PASSWORD_DEFAULT);
        return $this->passwd;
    }

    /**
     * Criptografia MD5
     * @param string $exReg
     * Espressão regular
     * @param string $imageName
     * Nome da imagem exem:  png|jpg|mpeg
     * @return string
     * Retorna uma nova criptografia
     */
    public function criptImage(array $file): string
    {
        if (empty($file)) throw new DataException("Null file",DataException::NOT_ACCEPTABLE);

        $ext = pathinfo($file["name"],PATHINFO_EXTENSION);
        $fileName = pathinfo($file["name"],PATHINFO_FILENAME);
        $this->imageName = strtoupper(uniqid(md5(time() . $fileName))) . "." . $ext;

        return $this->imageName;
    }

    /**
     * Cria um token de 8 bits
     * @param string $param
     * @return string
     * Retorna uma nova criptografia
     */
    public function createToken(string $param): string
    {
        if (empty($param)) throw new DataException("Null value",DataException::NOT_ACCEPTABLE);

        $numberRandom = random_int(100,1999);
        $this->key =  hash("sha512", uniqid(imap_binary($param)) . $numberRandom);

        return $this->key;
    }

    /**
     * @param string $param
     * O email a ser verificado
     * @return bool
     * Retorna true | false 
     */
    public function isEmail(string $param): bool
    {
        if (empty($param)) throw new DataException("Null value",DataException::NOT_ACCEPTABLE);

       return (preg_match("/^(.)+\@[a-zA-Z]+\.[a-zA-Z]+$/i",$param)) ? true : false;
    }

    /**
     * Verifica se o usuário está logado
     */
    public function isLogged($table):bool
    {
        if (isset($_COOKIE['_id']) || isset($_COOKIE['_token'])) {
            $token =  hash("whirlpool","ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$_SERVER['HTTP_USER_AGENT']}");
            $id = (strcasecmp($table,"empresa") === 0) ? "id_empresa" : "id_usuario";
            $this->sql->open();
            $row = $this->sql
                    ->show($table,"","$id = ?",3)
                    ->prepareParam([$_COOKIE['_id']])
                    ->executeSql();
            $this->sql->close();

            if (!empty($row)) {
                $id = $row[$id];
                if(strcasecmp($_COOKIE['_token'],$token) === 0 && strcasecmp($_COOKIE['_id'],$id) === 0 ) return true;
            }

        } 
        return false;
    }

    /**
     * @param string $bytes 
     * O tamanho da image em bytes
     * @param int $fixed
     * O tamanho fixo
     */
    public function getBytesFormat($bytes, $fixed = 2): string
    {
        $extByte = array("bytes","KB","MB","GB","TB","PB", "EB","ZB","YB");
        $espo =  floor(log($bytes) / log(1024));
        $size = round($bytes / pow(1024, $espo));
        return sprintf("%.{$fixed}f$extByte[$espo]", $size);
    }

    /**
     * @param array $arr
     * Um array associativo com chave/valor ou array único com chave/valor
     */
    public function toObject(array $arr): object
    {
        $object = new class{};
        foreach($arr as $in => &$v) {
            if(is_array($v))
                foreach($v as $key => &$val) $object->$key = $val;
            else
            $object->$in = $v;
        }  
        return $object;
    }

    /**
     * @param object $object
     * Um objeto 
     */
    public function toArray(object $object): array
    {
        $array = array();
        foreach($object as $key => $val) $array[$key] = $val;
        return $array;
    }

}
