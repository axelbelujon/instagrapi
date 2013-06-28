<?php

/**
 * Author : Axel Belujon (axel.belujon@gmail.com)
 * Date : May 2013
 */

namespace Aku\Bundle\InstaBundle\Service;


use Aku\Bundle\InstaBundle\Model\ClientInterface;

class Instagram {
    const INSTAGRAM_API_URL = "https://api.instagram.com";
    const INSTAGRAM_API_VERSION = 'v1';

    protected $client;

    protected $appId;
    protected $appSecret;
    protected $redirectUri;

    public function __construct(ClientInterface $client, $appId, $appSecret, $redirectUri)
    {
        $this->client = $client;

        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->redirectUri = $redirectUri;
    }

    /**
     * Get the Instagram URL to authenticate the application.
     * Used in Twig Extension Aku\Bundle\InstaBundle\Twig\Extension\InstaExtension
     * @return string the URL
     */
    public function getAuthUrl()
    {
        //https://api.instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=code

        $url = self::INSTAGRAM_API_URL;
        $url .= '/oauth/authorize/';
        $url .= '?client_id=' . $this->appId;
        $url .= '&redirect_uri=' . $this->redirectUri;
        $url .= '&response_type=code';

        return $url;
    }

    public function authenticate($code)
    {
        $authenticateUrl = self::INSTAGRAM_API_URL . '/oauth/access_token';

        $options = array('data' => array(
            'client_id' => $this->appId,
            'client_secret' => $this->appSecret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirectUri,
            'code' => $code
        ));

        return $this->client->execute('POST', $authenticateUrl, $options);
    }

    /**
     * @todo : put user calls into a separated class
     */
    public function getUserFeed($token)
    {
        $url = self::INSTAGRAM_API_URL . '/'.self::INSTAGRAM_API_VERSION.'/users/self/feed';
        $url .= '?access_token=' . $token;

        return json_decode($this->client->execute('GET', $url));
    }
}