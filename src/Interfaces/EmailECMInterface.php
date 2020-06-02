<?php

namespace Ecomais\Interfaces;

use Ecomais\Models\DataException;

 interface EmailECMInterface {

   /**
     * Adiciona o corpo da mensagem para o envio do email
     * @param string $subject
     * @param string $body
     * @param string $altBody
     * @param string $recipient_name
     * @param string $recipient_name
     * @return EmailECM
     */
    public function add(string $subject, string $body, string $recipient_name, string $recipient_email, string $altBody = ""): EmailECMInterface;

    /**
     * Adiciona as imagens ou vídeos para o envio do email
     * @param string $filePath
     * @param string $fileName
     * @return EmailECM
     */
    public function attach(string $filePath, string $fileName): EmailECMInterface;

     /**
     * Envia os dados para email destinatário
     * @param string $from_name
     * @param string $from_email
     * @return bool
     */
    public function send(string $from_name = parent::FROM_NAME, string $from_email = parent::FROM_EMAIL): bool;

    /**
     * Exceções de erros
     * @return DataException
     */
    public function error(): DataException;
 } 