<?php

namespace Ecomais\ControllersServices;

use League\OAuth2\Client\Provider\Facebook;

class AuthFacebook {
    private $authFacebook;

    private $configAuthUser = [
        'clientId'          => '250815926067653',
        'clientSecret'      => '82113b4fd000364aaae6a6e21a6e7a99',
        'redirectUri'       => 'https://www.localhost/www/EcoMais',
        'graphApiVersion'   => 'v7.0',
    ];

    public function __construct() {
        $this->authFacebook = new Facebook($this->configAuthUser);  
    }



}