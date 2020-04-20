<?php
namespace Server;

use Model\{DataException,EmailProps};
use PHPMailer\PHPMailer\{PHPMailer,Exception};

class EmailECM  extends EmailProps {
    /**
     * @var PHPMailer 
     * */
    private $email;

    private $err;



    /**
     * CONSTRUCT 
     * @return void
     */
    public function __construct() {
        $this->email = new PHPMailer(true);
  
        $this->email->isSMTP();
        $this->email->isHTML();
        $this->email->setLanguage("br");
        $this->email->SMTPAuth= true;
        $this->email->CharSet = PHPMailer::CHARSET_UTF8;
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;


        $this->email->Host = parent::HOST_EM;
        $this->email->Port = parent::PORT_EM;
        $this->email->Username = parent::USER_EM; 
        $this->email->Password = parent::PASSWD_EM;
        
    }
    /**
     * Adiciona o corpo da mensagem para o envio do email
     * @param string $subject
     * @param string $body
     * @param string $altBody
     * @param string $recipient_name
     * @param string $recipient_name
     * @return EmailECM
     */
    public function add(string $subject,string $body,string $altBody, string $recipient_name,string $recipient_email):EmailECM
    {
        $this->$subject = $subject;
        $this->body = $body;
        $this->altBody = $altBody;
        $this->recipient_Name = $recipient_name;
        $this->recipient_Email = $recipient_email;

        return $this;
    }

    /**
     * Adiciona as imagens ou vídeos para o envio do email
     * @param string $filePath
     * @param string $fileName
     * @return EmailECM
     */
    public function attach(string $filePath, string $fileName):EmailECM
    {
        $this->attach[$filePath] = $fileName;   

        return $this;
    }

    /**
     * Envia os dados para email destinatário
     * @param string $from_name
     * @param string $from_email
     * @return bool
     */
    public function send(string $from_name = parent::FROM_NAME,string $from_email = parent::FROM_EMAIL):bool
    {

        try
        {

            $this->email->setFrom($from_email,$from_name);
            $this->email->addAddress($this->recipient_Email,$this->recipient_Name);
            $this->email->Subject = $this->subject;
            $this->email->msgHTML($this->body);
            $this->email->AltBody = $this->altBody;

            if(!empty($this->attach)) {
                foreach($this->attach as $path => $name) {
                    $this->email->addAttachment($path,$name);
                }
            }

            $this->email->send();
            return true;
        }catch(Exception $ex) 
        {
            $this->err = $ex->getMessage();
            return false;
        }
    }
    /**
     * @return DataException
     */
    public function error():DataException
    {  
        return new DataException($this->err);
    }
}