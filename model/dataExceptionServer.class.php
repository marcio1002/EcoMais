<?php

namespace Model;

use Exception;

class DataException extends Exception {
 
    const NOT_CONTENT = 204;
    const NOT_RESET = 205;
    const NOT_MODIFIED = 304;
    const REQ_INVALID = 400;
    const NOT_AUTHORIZED = 401;
    const REQ_PAYMENT_REQUIRED = 402;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const AUTHENTICATION_REQUIRED = 407;
    const REQ_TIME_OVER = 408;
    const REQUIRED_LENGTH = 411;
    const NOT_IMPLEMENTED = 501;
    const HTTP_NOT_SUPPORTED = 505;


    final public function __construct($message, $code = 0, Exception $excep = null)
    {
        parent::__construct($message,$code,$excep);
    }

    final public function message():string 
    {
        return $this->message;
    }

    final public function code():int
    {
        return $this->code;
    }

    final public function line():string
    {
        return $this->line;
    }
}