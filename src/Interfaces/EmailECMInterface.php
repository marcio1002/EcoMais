<?php

namespace Ecomais\Interfaces;

use Ecomais\Models\DataException;

 interface EmailECMInterface {
    public function add(string $subject, string $body, string $recipient_name, string $recipient_email, string $altBody = ""): EmailECMInterface;

    public function attach(string $filePath, string $fileName): EmailECMInterface;

    public function send(string $from_name = parent::FROM_NAME, string $from_email = parent::FROM_EMAIL): bool;

    public function error(): DataException;
 } 