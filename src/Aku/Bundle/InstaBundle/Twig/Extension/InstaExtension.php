<?php

/**
 * Author : Axel Belujon (axel.belujon@gmail.com)
 * Date : May 2013
 */

namespace Aku\Bundle\InstaBundle\Twig\Extension;

use Aku\Bundle\InstaBundle\Service\Instagram;

class InstaExtension extends \Twig_Extension
{

    protected $instagram;

    public function __construct(Instagram $instagram)
    {
        $this->instagram = $instagram;
    }

    public function getFunctions()
    {
        return array(
            'instagram_signin_btn' => new \Twig_Function_Method($this, 'getInstagramSignin', array('is_safe' => array('html'))),
        );
    }

    public function getInstagramSignin($assetUrl)
    {
        $title = 'Sign in with Instagram';
        $link = '<a href="'.$this->instagram->getAuthUrl().'"><img src="'.$assetUrl.'" alt="'.$title.'" title="'.$title.'" /></a>';

        return $link;
    }

    public function getName()
    {
        return 'aku_insta_extension';
    }
}