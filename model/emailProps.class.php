<?php

namespace Model;

abstract class EmailProps {
    
    const HOST_EM = "smtp.gmail.com";
    const PORT_EM = '465';
    const USER_EM = "marcioalemao1993@gmail.com";
    const PASSWD_EM = "";
    const FROM_NAME = "Marcio Alemão";
    const FROM_EMAIL = "marcioalemao1993@gmail.com";

    protected $subject;

    protected $body;

    protected $altBody;

    protected $recipient_Name;
    
    protected $recipient_Email;

    protected $attach;
}