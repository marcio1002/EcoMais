<?php
namespace Ecomais\Services;

use Ecomais\Models\{DataException, EmailProps};
use PHPMailer\PHPMailer\{PHPMailer, Exception, SMTP};

class EmailECM  extends EmailProps 
{
    /**
     * @var PHPMailer 
     * */
    private $email;

    public function __construct()
    {
        $this->email = new PHPMailer(true);

        $this->email->isSMTP();
        $this->email->SMTPDebug = 2;
        $this->email->isHTML(true);
        $this->email->setLanguage("br");
        $this->email->SMTPAuth = true;
        $this->email->SMTPAutoTLS = true;
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->email->CharSet = PHPMailer::CHARSET_UTF8;


        $this->email->Host = parent::HOST_EM;
        $this->email->Port = parent::PORT_EM;
        $this->email->Username = parent::USER_EM;
        $this->email->Password = parent::PASSWD_EM;
    }
    
    public function add(string $subject, string $body, string $recipient_name, string $recipient_email, string $altBody = ""): EmailECM
    {
        $this->subjecProp = $subject;
        $this->bodyProp = $body;
        $this->altBodyProp = $altBody;
        $this->recipient_Name = $recipient_name;
        $this->recipient_Email = $recipient_email;

        return $this;
    }

    
    public function attach(string $filePath, string $fileName): EmailECM
    {
        $this->attachProp[$filePath] = $fileName;

        return $this;
    }

   
    public function send(string $from_name = parent::FROM_NAME, string $from_email = parent::FROM_EMAIL): bool
    {

        try {

            $this->email->setFrom($from_email, $from_name);
            $this->email->addAddress($this->recipient_Email, $this->recipient_Name);
            $this->email->Subject = $this->subjecProp;
            $this->email->msgHTML($this->bodyProp);
            $this->email->AltBody = $this->altBodyProp;

            if (!empty($this->attachProp))
                foreach ($this->attachProp as $path => $name)
                    $this->email->addAttachment($path, $name);

            $this->email->send();
            return true;
        } catch (Exception $ex) {
            throw new DataException($ex->getMessage(),$ex->getCode());
        }
        return false;
    }
}
