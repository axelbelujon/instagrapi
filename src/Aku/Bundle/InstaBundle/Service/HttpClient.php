<?php

/**
 * Author : Axel Belujon (axel.belujon@gmail.com)
 * Date : May 2013
 */

namespace Aku\Bundle\InstaBundle\Service;

use Aku\Bundle\InstaBundle\Model\ClientInterface;

class HttpClient implements ClientInterface {

    /**
     * @param $method : GET|POST
     * @param $url : URL to reach
     * @param array $options | array of options to use for the request
     */
    public function execute($method, $url, $options = array()) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        switch(strtoupper($method)) {
            case 'POST':
                if(!isset($options['data'])) {
                    throw new \Exception('The "data" option is missing for the POST request on the URL "'.$url.'".');
                }
                $fields = $options['data'];
                curl_setopt($ch, CURLOPT_POST, count($fields));
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
                break;
            case 'GET':
            default:
                break;
        }

        // Get rid of the SSL verification for local tests
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        if(!$result) {
            throw new \Exception('curl error when trying to access ressource : ' . curl_error($ch) . '(' . curl_errno($ch) . ')');
        }

        curl_close($ch);

        return $result;

    }
}