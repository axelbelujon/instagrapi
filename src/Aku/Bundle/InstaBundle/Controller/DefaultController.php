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
     * @Route("/", name="instagrapi_home")
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
     * @Route("/auth", name="instagrapi_auth")
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
                $session = $this->get('session');
                $session->set('instagram_access_token', $auth->access_token);
                $session->set('instagram_user', $auth->user);

                return $this->redirect($this->generateUrl('instagrapi_pictures'));
            } else {
                // @todo : Handle error code and message
            }
        } else {
            // @todo : Handle error code and message
        }

        return new Response('');
    }

    /**
     * @Route("/pictures", name="instagrapi_pictures")
     * @Template()
     */
    public function picturesAction()
    {
        $session = $this->get('session');

        $token = $session->get('instagram_access_token', null);

        if(isset($token)){
            return array();
        } else {
            return $this->redirect($this->generateUrl('instagrapi_home'));
        }
    }
}
