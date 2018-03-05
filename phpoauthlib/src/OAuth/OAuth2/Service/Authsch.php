<?php

namespace OAuth\OAuth2\Service;

use OAuth\OAuth2\Service\Exception\InvalidServiceConfigurationException;
use OAuth\OAuth2\Token\StdOAuth2Token;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Consumer\CredentialsInterface;
use OAuth\Common\Http\Client\ClientInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Http\Uri\UriInterface;

class Authsch extends AbstractService
{
    const SCOPE_BASIC                         = 'basic';
    // extended permissions
    const SCOPE_DISPLAYNAME                   = 'displayName';
    const SCOPE_SURNAME                       = 'sn';
    const SCOPE_GIVENNAME                     = 'givenName';
    const SCOPE_MAIL                          = 'mail';
    const SCOPE_NEPTUN                        = 'niifPersonOrgID';
    const SCOPE_LINKEDACCOUNTS                = 'linkedAccounts';
    const SCOPE_CIRCLES                       = 'eduPersonEntitlement';
    const SCOPE_ROOM                          = 'roomNumber';
    const SCOPE_MOBILE                        = 'mobile';
    const SCOPE_COURSES                       = 'niifEduPersonAttendedCourse';
    const SCOPE_ENTRANTS                      = 'entrants';
    const SCOPE_ADMEMBERSHIP                  = 'admembership';
    const SCOPE_BMEUNIT                       = 'bmeunitscope';


        /**
     * {@inheritdoc}
     */
    public function getAuthorizationEndpoint()
    {
        return new Uri('https://auth.sch.bme.hu/site/login');
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessTokenEndpoint()
    {
        return new Uri('https://auth.sch.bme.hu/oauth2/token');
    }


    /**
     * {@inheritdoc}
     */
    protected function getAuthorizationMethod()
    {
        return static::AUTHORIZATION_METHOD_QUERY_STRING;
    }

    /**
     * {@inheritdoc}
     */
    protected function parseAccessTokenResponse($responseBody)
    {
        $data = json_decode($responseBody, true);

        if (null === $data || !is_array($data)) {
            throw new TokenResponseException('Unable to parse response.');
        } elseif (isset($data['error'])) {
            throw new TokenResponseException('Error in retrieving token: "' . $data['error'] . '"');
        }

        $token = new StdOAuth2Token();
        $token->setAccessToken($data['access_token']);

        if (isset($data['expires'])) {
            $token->setLifeTime($data['expires']);
        }

        if (isset($data['refresh_token'])) {
            $token->setRefreshToken($data['refresh_token']);
            unset($data['refresh_token']);
        }

        unset($data['access_token']);
        unset($data['expires']);

        $token->setExtraParams($data);

        return $token;
    }
}
