<?php

namespace Ecomais\Models;

use Ecomais\Models\DataException;
use League\OAuth2\Client\Provider\Facebook;

class AuthFacebook {
    private $facebook;

    private $configAuthUser = [
        'clientId'          => '250815926067653',
        'clientSecret'      => '82113b4fd000364aaae6a6e21a6e7a99',
        'redirectUri'       => BASE_URL . "/manager/loginfacebook",
        'graphApiVersion'   => 'v7.0',
    ];

    public function __construct() 
    {
        $this->facebook = new Facebook($this->configAuthUser);  
    }

    public function getAuthURL(...$scope):string
    {
        return $this->facebook->getAuthorizationUrl([
            "scope" => [implode(",",$scope)]
        ]) ;
    }

    public function getState():string
    {
        return $this->facebook->getState();
    }

    public function getData(string $code)
    {
        if(empty($code)) throw new DataException("No code provided");

        $token = $this->facebook->getAccessToken('authorization_code',[
            'code' => $code
        ]);

        return $this->facebook->getResourceOwner($token);
    }

}
