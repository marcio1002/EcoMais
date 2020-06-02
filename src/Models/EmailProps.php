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

    protected string $subjecProp;

    protected string $bodyProp;

    protected string $altBodyProp;

    protected string $recipient_Name;

    protected string $recipient_Email;

    protected array $attachProp;
}
