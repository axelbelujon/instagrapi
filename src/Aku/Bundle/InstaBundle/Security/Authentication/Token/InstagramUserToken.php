<?php

namespace Aku\Bundle\InstaBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class InstagramUserToken extends AbstractToken
{
    public $created;
    public $digest;
    public $nonce;

    public function __construct($uid, array $roles = array(), $accessToken = null)
    {
        parent::__construct($roles);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }
}