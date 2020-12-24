<?php
namespace Ecomais\Models;

abstract class EmailProps
{

    const HOST_EM = EMAIL_PROPS["HOST"];
    const PORT_EM = EMAIL_PROPS["PORT"];
    const USER_EM = EMAIL_PROPS["EMAIL"];
    const PASSWD_EM = EMAIL_PROPS["PASSWD"];
    const FROM_NAME = "User";
    const FROM_EMAIL = "Email User";

    protected string $subjecProp;

    protected string $bodyProp;

    protected string $altBodyProp;

    protected string $recipient_Name;

    protected string $recipient_Email;

    protected array $attachProp;
}
