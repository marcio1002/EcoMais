<?php

namespace Ecomais\Models;

use Ecomais\Models\DataException;
use Exception;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AuthGoogle
{

    private Google $google;
    private static Implementation $implement;

    public function __construct($redirect)
    {
        $this->configAuthUser = [
            'clientId'          => '580621536071-2n4itptpg20oephtqhmi4bgcdlu2dfg5.apps.googleusercontent.com',
            'clientSecret'      => 'SozYVrSystXUHxGwqizHwj6j',
            'redirectUri'       => renderUrl($redirect),
            'graphApiVersion'   => 'v7.0',
            'accessType'   => 'offline'
        ];

        $this->google = new Google($this->configAuthUser);
        static::$implement = new Implementation;
    }

    /**
     * Verifica se a possível ataque de CSRF
     * @param $state
     * O estado do Oauth Google
     * @return bool
     */
    private function verifyState($state): bool
    {
        static::$implement->getSession(["read_and_close" => true]);
        return (isset($_SESSION['oauthgoogle_state']) && ($_SESSION['oauthgoogle_state'] <=> $state) == 0) ?: false;
    }

    /**
     * @param mixed ...$scope
     * Escopos de acessos a dados do google 
     * @return string
     * Retorna a url para o acesso ao OAuth do Google
     */
    public function getOauthURL(...$scope): string
    {
        static::$implement->getSession(["cookie_lifetime" => 3600 +  time()]);

        $url = $this->google->getAuthorizationUrl([
            "scope" => [implode(",", $scope)]
        ]);

        $_SESSION["oauthgoogle_state"] = $this->getState();
        session_write_close();
        return $url;
    }

    /**
     * verificar o status 
     * @return string
     * Retorna o status
     */
    public function getState(): string
    {
        return $this->google->getState();
    }

    /**
     * @param string $code
     * Um token de retorno do OAuth do google 
     * @return \league\OAuth2\Client\Provider\ResourceOwnerInterface|null
     * Retorna os dados do cliente de email ou null
     */
    public function getData(string $code, $state): ?\league\OAuth2\Client\Provider\ResourceOwnerInterface
    {
        try {
            if ($this->verifyState($state)) {
                static::$implement->getSession(["cookie_lifetime" => 3600 +  time()]);

                $token = $this->google->getAccessToken('authorization_code', [
                    "code" => $code
                ]);

                $_SESSION['oauthgoogle_token'] = [$token, $token->getRefreshToken()];
                return $this->google->getResourceOwner($token);
            }
        } catch (Exception $ex) {
            goto end;
        } finally {
            session_write_close();
        }
        end: return null;
    }

    /**
     * Verifica e retorna o token expirado
     *  @return League\OAuth2\Client\Token\AccessTokenInterface|false
     * retorna o token Expirado ou falso
     */
    public function tokenExpired()
    {
        static::$implement->getSession();
        if (isset($_SESSION['oauthgoogle_token']) && $_SESSION['oauthgoogle_token']["oauthToken"]->hasExpired()) {
            [$oauthToken,$refreshToken] = $_SESSION['oauthgoogle_token'];
            $token = $this->google->getAccessToken("refresh_token", [
                "refresh_token" => $refreshToken
            ]);
            session_unset();
            session_destroy();
            return $token;
        }

        session_write_close();

        return false;
    }
}
