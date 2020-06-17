<?php
/**
 * Default settings for the oauth plugin
 *
 * @author Andreas Gohr <andi@splitbrain.org>
 */

$conf['auth0-key']           = '';
$conf['auth0-secret']        = '';
$conf['auth0-domain']        = '';
$conf['custom-redirectURI']  = '';
$conf['facebook-key']        = '';
$conf['facebook-secret']     = '';
$conf['github-key']          = '';
$conf['github-secret']       = '';
$conf['authsch-key']          = '';
$conf['authsch-secret']       = '';
$conf['authsch-circles-json']          = "{ \"44\": \"ha5kfu\" }";
$conf['authsch-roles-json']       = "{  \"PR menedzser\": \"pr\" }";
$conf['authsch-allow-outside-circles']          = 0;
$conf['google-key']          = '';
$conf['google-secret']       = '';
$conf['dataporten-key']      = '';
$conf['dataporten-secret']   = '';
$conf['keycloak-key']        = '';
$conf['keycloak-secret']     = '';
$conf['keycloak-authurl']    = 'https://keycloak.example.com/auth/realms/{realm}/protocol/openid-connect/auth';
$conf['keycloak-tokenurl']   = 'https://keycloak.example.com/auth/realms/{realm}/protocol/openid-connect/token';
$conf['keycloak-userinfourl'] = 'https://keycloak.example.com/auth/realms/{realm}/protocol/openid-connect/userinfo';
$conf['yahoo-key']           = '';
$conf['yahoo-secret']        = '';
$conf['doorkeeper-key']      = '';
$conf['doorkeeper-secret']   = '';
$conf['doorkeeper-authurl']  = 'https://doorkeeper-provider.herokuapp.com/oauth/authorize';
$conf['doorkeeper-tokenurl'] = 'https://doorkeeper-provider.herokuapp.com/oauth/token';
$conf['mailRestriction']     = '';
$conf['singleService']       = '';
$conf['register-on-auth']    = 0;
