<?php

namespace Aku\Bundle\InstaBundle\Security\Authentication;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;
use Aku\Bundle\InstaBundle\Entity\User;

class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{

    public function __construct()
    {
    }


    function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

    }
}