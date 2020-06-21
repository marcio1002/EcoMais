<?php

namespace Ecomais\Models;

use Ecomais\Models\DataException;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

class AuthGoogle {

    private $google;

    private $configAuthUser = [
        'clientId'          => '580621536071-2n4itptpg20oephtqhmi4bgcdlu2dfg5.apps.googleusercontent.com',
        'clientSecret'      => 'SozYVrSystXUHxGwqizHwj6j',
        'redirectUri'       => BASE_URL . "/manager/logingoogle",
        'graphApiVersion'   => 'v7.0',
    ];

    public function __construct() 
    {
        $this->google = new Google($this->configAuthUser);  
    }

    public function getAuthURL(...$scope):string
    {
        return $this->google->getAuthorizationUrl([
            "scope" => [implode(",",$scope)]
        ]) ;
    }

    public function getState():string
    {
        return $this->google->getState();
    }

    public function getData(string $code)
    {
        if(empty($code)) throw new DataException("No code provided");

        $token = $this->google->getAccessToken('authorization_code',[
            'code' => $code
        ]);

        return $this->google->getResourceOwner($token);
    }

}
