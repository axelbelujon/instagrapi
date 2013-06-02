<?php

namespace Aku\Bundle\InstaBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Aku\Bundle\InstaBundle\Security\Authentication\Token\InstagramUserToken;

class InstagramListener extends AbstractAuthenticationListener
{
    protected function attemptAuthentication(Request $request)
    {

        $accessToken = $request->get('access_token');

        return $this->authenticationManager->authenticate(new InstagramUserToken($this->providerKey, '', array(), $accessToken));
    }
}