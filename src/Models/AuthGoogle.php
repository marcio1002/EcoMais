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
        session_name("ecomais_googlesession");
        static::$implement->getSession(["read_and_close" => true]);
        return (isset($_SESSION['oauthgoogle_state']) && ($_SESSION['oauthgoogle_state'] <=> $state) == 0);
    }

    /**
     * @param mixed ...$scope
     * Escopos de acessos a dados do google 
     * @return string
     * Retorna a url para o acesso ao OAuth do Google
     */
    public function getOauthURL(...$scope): string
    {
        session_name("ecomais_googlesession");
        static::$implement->getSession(["cookie_lifetime" => time() + (60 * 40)]);

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
                $token = $this->google->getAccessToken('authorization_code', [
                    "code" => $code
                ]);

                session_name("ecomais_googlesession");
                static::$implement->getSession(["cookie_lifetime" => time() + (60 * 40)]);
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
        session_name("ecomais_googlesession");
        static::$implement->getSession();

        if (isset($_SESSION['oauthgoogle_token']) && $_SESSION['oauthgoogle_token'][0]->hasExpired()) {
            [$oauthToken, $refreshToken] = $_SESSION['oauthgoogle_token'];
            $token = $this->google->getAccessToken("refresh_token", [
                "refresh_token" => $refreshToken
            ]);
            $this->unsetSession();
            return $token;
        }

        session_write_close();

        return false;
    }

    public function unsetSession()
    {
        if($this->isSession()) {
            session_name("ecomais_googlesession");
            static::$implement->getSession();
            unset($_SESSION['oauthgoogle_token']);
            unset($_SESSION['oauthgoogle_state']);
            session_write_close();
        }
    }

    public function isSession(): bool
    {
        session_name("ecomais_googlesession");
        static::$implement->getSession(["read_and_close" => true]);
        return (isset($_SESSION['oauthgoogle_token']) || isset($_SESSION['oauthgoogle_state']));
    }
}
