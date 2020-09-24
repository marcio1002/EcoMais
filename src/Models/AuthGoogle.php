<?php

namespace Ecomais\Models;

use Ecomais\Models\DataException;
use Exception;
use League\OAuth2\Client\Provider\Google;

class AuthGoogle {

    private Google $google;

    public function __construct($redirect) 
    {
        $this->configAuthUser = [
            'clientId'          => '580621536071-2n4itptpg20oephtqhmi4bgcdlu2dfg5.apps.googleusercontent.com',
            'clientSecret'      => 'SozYVrSystXUHxGwqizHwj6j',
            'redirectUri'       => BASE_URL . $redirect,
            'graphApiVersion'   => 'v7.0',
        ];
        
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

    public function getData(string $code): ?\league\OAuth2\Client\Provider\ResourceOwnerInterface
    {
        try{
            if(empty($code)) throw new DataException("No code provided");

            $token = $this->google->getAccessToken('authorization_code',[
                'code' => $code
            ]);

            return $this->google->getResourceOwner($token);

        }catch(Exception $ex) {
           return null;
        }
    }

}
