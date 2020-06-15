<?php

namespace Ecomais\ControllersServices;

use Ecomais\Models\DataException;
use League\OAuth2\Client\Provider\Facebook;

class AuthFacebook {
    private $facebook;

    private $configAuthUser = [
        'clientId'          => '250815926067653',
        'clientSecret'      => '82113b4fd000364aaae6a6e21a6e7a99',
        'redirectUri'       => 'https://www.localhost/www/EcoMais',
        'graphApiVersion'   => 'v7.0',
    ];

    public function __construct() 
    {
        $this->facebook = new Facebook($this->configAuthUser);  
    }

    public function getAuthURL(...$scope):string
    {
        return $this->facebook->getAuthorizationUrl($scope) ;
    }

    public function getState():string
    {
        return $this->facebook->getState();
    }

    public function setUserFace(string $code):void 
    {
        if(empty($token)) throw new DataException("No code provided");
        $token = $this->facebook->getAccessToken('authorization_code',[
            'code' => $code
        ]);
    }

}
