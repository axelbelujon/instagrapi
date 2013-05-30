<?php

namespace Aku\Bundle\InstaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AkuInstaExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $exposed = array('app_id', 'app_secret', 'redirect_uri');

        foreach($exposed as $exp) {
            if (!isset($config[$exp])) {
                throw new \InvalidArgumentException(
                    'The "'.$exp.'" option must be set'
                );
            }

            $container->setParameter(
                'aku_insta.' . $exp,
                $config[$exp]
            );
        }
    }
}
