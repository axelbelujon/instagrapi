<?php

namespace Aku\Bundle\InstaBundle\Security\Authentication;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;
use Aku\Bundle\InstaBundle\Entity\User;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    public function __construct()
    {
    }


    function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

    }
}