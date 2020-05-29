<?php
namespace Ecomais\Models;

abstract class EmailProps
{

    const HOST_EM = "smtp.gmail.com";
    const PORT_EM = '587';
    const USER_EM = "ecomais5354@gmail.com";
    const PASSWD_EM = "ecoMaisDeveloper";
    const FROM_NAME = "EcoMais";
    const FROM_EMAIL = "ecomais5354@gmail.com";

    protected $subjecProp;

    protected $bodyProp;

    protected $altBodyProp;

    protected $recipient_Name;

    protected $recipient_Email;

    protected $attachProp;
}
