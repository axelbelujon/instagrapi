<?php

/**
 * Author : Axel Belujon (axel.belujon@gmail.com)
 * Date : May 2013
 */

namespace Aku\Bundle\InstaBundle\Model;

interface ClientInterface {
    public function execute($method, $url, $options = array());
}