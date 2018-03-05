<?php

namespace OAuth\Plugin;

use OAuth\OAuth2\Service\Authsch;

class AuthschAdapter extends AbstractAdapter {

    /**
     * Retrieve the user's data
     *
     * The array needs to contain at least 'user', 'mail', 'name' and optional 'grps'
     *
     * @return array
     */
    public function getUser() {
        // vir circle id to dokuwiki group
        $circles2groups = array(
            434 => 'cc',
            56 => 'dezso',
            357 => 'hetifonok',
            465 => 'justdance',
            421 => 'lanosch',
            393 => 'parkett',
            137 => 'szakest'
        );
        $JSON = new \JSON(JSON_LOOSE_TYPE);
        $data = array();

        /** var OAuth\OAuth2\Service\Generic $this->oAuth */
        $result = $JSON->decode($this->oAuth->request('https://auth.sch.bme.hu/api/profile/'));
        $data['user'] = $result['linkedAccounts']['schacc'];
        $data['name'] = $result['displayName'];
        $data['mail'] = $result['mail'];
        $data['grps'] = array();
        foreach($result['eduPersonEntitlement'] as $circle){
            if(isset($circles2groups[$circle['id']])){
                $data['grps'][]=$circles2groups[$circle['id']];
                if($circle['status']=='tag'){
                    if(in_array('gazdaságis',$circle['title'])){
                        $data['grps'][]='gazdasagis';
                    }
                }else if($circle['status']=='körvezető'){
                    $data['grps'][]='korvez';
                }
            }
            
        }
        if(count($data['grps'])==0)return null;
        //if(count($data['grps'])>0)$data['grps'][]='user';
        
        return $data;
    }


    /**
     * Access to user and his email addresses
     *
     * @return array
     */
    public function getScope() {
        return array(Authsch::SCOPE_BASIC, Authsch::SCOPE_DISPLAYNAME, Authsch::SCOPE_MAIL, Authsch::SCOPE_LINKEDACCOUNTS, Authsch::SCOPE_CIRCLES);
    }
}