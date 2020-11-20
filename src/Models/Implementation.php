<?php

namespace Ecomais\Models;

use Ecomais\Models\DataException;
use Ecomais\Services\Data;

class Implementation
{

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
        if (empty($passwd)) throw new DataException("Null value", DataException::NOT_ACCEPTABLE);

        return password_hash($passwd, PASSWORD_DEFAULT);
    }

    /**
     * Criptografia de imagem de 128 bits
     * @param string $file
     * um array da variável global
     * @return string
     */
    public function criptImage(array $file): string
    {
        if (empty($file)) throw new DataException("Null file", DataException::NOT_ACCEPTABLE);
        ["filename" => $filename, "extension" => $extension] = pathinfo($file["name"]);

        return strtoupper(uniqid(hash("whirlpool", time() . $filename))) . "." . $extension;
    }

    /**
     * Cria um token de 128 bits
     * @param string $param
     * @return string
     */
    public function createToken(string $param): string
    {
        if (empty($param)) throw new DataException("Null value", DataException::NOT_ACCEPTABLE);
        return hash("sha512", uniqid(time() . base64_encode($param)  . random_bytes(16)));
    }


    /**
     * @param string $param
     * O email a ser verificado
     * @return bool 
     */
    public function isEmail(string $mail): bool
    {
        if (empty($mail)) throw new DataException("Null value", DataException::NOT_ACCEPTABLE);
        
        return (preg_match("/^\S+\@\S+\.[a-zA-Z]+$/i", trim($mail))) ? true : false;
    }

    /**
     * Verifica o cnpj e a retorna, Se não retorna falso
     * @param string $cnpj
     * O cnpj a ser verificado
     * @return int|bool
     */
    public function isCnpj(string $cnpj)
    {
        if (empty($cnpj)) throw new DataException("Null value", DataException::NOT_ACCEPTABLE);
        $cnpj = preg_replace("/\D/", "", trim($cnpj));

        return  (strlen($cnpj) === 14 && is_numeric($cnpj))? (int) $cnpj :  false;
    }

    /**
     * Verifica se o usuário está logado
     * @return bool
     */
    public function isLogged($table): bool
    {
        session_name("ecomais_session");
        $this->getSession(['read_and_close'  => true]);
        if (isset($_COOKIE['_id']) && isset($_COOKIE["_sessidcookie"])) {
            $id = (($table <=> "empresa") === 0) ? "id_empresa" : "id_usuario";

            $this->sql->open();
            $row = $this->sql
                ->show($table, "", "$id = ?", 3)
                ->prepareParam([$_COOKIE['_id']])
                ->executeSql();
            $this->sql->close();

            $token =  hash("whirlpool", "ARBDL{$_SERVER['REMOTE_ADDR']}ARBDL{$row["email"]}{$_SERVER['HTTP_USER_AGENT']}");

            if (!empty($row)) {
                if (
                    ($_COOKIE["_sessidcookie"] <=> $token) === 0 &&
                    ($_COOKIE['_id'] <=> $row[$id]) === 0
                )
                    return true;
            }
        }
        return false;
    }

    /**
     * @param array $arr
     * Um array associativo com chave/valor ou array único com chave/valor
     * @return object
     */
    public function toObject(array $arr): object
    {
        $object = new class{};
        
        foreach ($arr as $property => $val) {
            if (is_array($val)) $this->toObject($val);

            $object->{$property} = $val;
        }
        return $object;
    }

    /**
     * @param object $object
     * Um objeto a ser convertido
     * @return array
     */
    public function toArray(object $object): array
    {
        $classAnonymous = new class{};
        $classAnonymous->object = $object;
        $array = [];

        foreach ($classAnonymous->object as $property => $val) $array[$property] = $val;

        return $array;
    }

    /**
     * Por questões de usar muito a session verificando se ela está ativa
     * Foi criada essa função pra diminuir repetição de código
     * @return bool
     */
    public function getSession(array $optionsSession = []): bool
    {
        if (session_status() == PHP_SESSION_DISABLED || session_status() == PHP_SESSION_NONE) {
            session_start($optionsSession);
            return true;
        }

        return false;
    }

    /**
     * Limpar os valores do array da sessão, destroy e fecha.
     * @return bool
     */
    public function destroyCloseSession(): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
            session_write_close();
            return true;
        }
        return false;
    }

    /**
     * Limpa os cookies 
     * OBS: Os cookies precisam está com  a sessão ativa
     * @param string[] ...$cookiesKey 
     * Um array com chave dos valores do cookie
     * @return bool
     */
    public function destroyCookie(string ...$cookiesKey): bool
    {
        if(session_status() === PHP_SESSION_ACTIVE) {
            foreach($cookiesKey as &$cookie) {
                setcookie($cookie, "", 0, "/");
            }
            return true;
        }
        return false;
    }
}
