<?php
namespace Ecomais\Models;

abstract class EmailProps
{

    const HOST_EM = "smtp.gmail.com";
    const PORT_EM = '587';
    const USER_EM = "EcoMais";
    const PASSWD_EM = "ecoMaisDeveloper";
    const FROM_NAME = "Marcio Alemão";
    const FROM_EMAIL = "ecomais5354@gmail.com";

    protected $subjecProp;

    protected $bodyProp;

    protected $altBodyProp;

    protected $recipient_Name;

    protected $recipient_Email;

    protected $attachProp;
}
