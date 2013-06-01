<?php

namespace Aku\Bundle\InstaBundle;

use Aku\Bundle\InstaBundle\Security\Factory\InstagramFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AkuInstaBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new InstagramFactory());
    }
}
