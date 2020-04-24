<?php

namespace Model;

abstract class EmailProps {
    
    const HOST_EM = "smtp.gmail.com";
    const PORT_EM = '465';
    const USER_EM = "marcioalemao1993@gmail.com";
    const PASSWD_EM = "M.imortal2009";
    const FROM_NAME = "Marcio Alemão";
    const FROM_EMAIL = "marcioalemao1993@gmail.com";

    protected $subjecProp;

    protected $bodyProp;

    protected $altBodyProp;

    protected $recipient_Name;
    
    protected $recipient_Email;

    protected $attachProp;
}