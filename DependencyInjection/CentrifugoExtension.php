<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 15.03.18
 * Time: 14:43
 */

namespace Kismia\CentrifugoBundle\DependencyInjection;


use Kismia\CentrifugoBundle\Client\CentrifugoClient;
use Kismia\CentrifugoBundle\DependencyInjection\Configuration\Configuration;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CentrifugoExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('centrifugo.apiendpoint', $config['apiendpoint']);
        $container->setParameter('centrifugo.secret', $config['secret']);
        $container->setParameter('centrifugo.transport', $config['transport']);

    }

}