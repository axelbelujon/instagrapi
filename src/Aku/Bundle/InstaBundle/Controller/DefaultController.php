<?php

namespace Aku\Bundle\InstaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $instagram = $this->get('aku.instagram');

        return array();
    }

    /**
     * Redirect URI from Instagram.
     * If code is set, everything went fine. If not, an error message must be set
     * @Route("/auth")
     */
    public function authAction(Request $request)
    {
        $code = $request->query->get('code', null);

        if(isset($code)) {
            $instagram = $this->get('aku.instagram');

            $auth = $instagram->authenticate($code);
            $auth = json_decode($auth);

            // $access should contain "access_token"
            if(isset($auth->access_token)) {

            } else {
                // @todo : Handle error code and message
            }
        } else {
            // @todo : Handle error code and message
        }

        return new Response('');
    }
}
