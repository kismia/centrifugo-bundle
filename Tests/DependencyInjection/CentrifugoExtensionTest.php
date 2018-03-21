<?php

namespace Kismia\CentrifugoBundle\Tests\DependencyInjection;

use Kismia\CentrifugoBundle\DependencyInjection\CentrifugoExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class CentrifugoExtensionTest extends TestCase
{

    public function testLoad()
    {
        $config = [
            'centrifugo' => [
                'apiendpoint' => 'localhost',
                'secret' => 'api-secret',
                'transport' => [
                    'redis' => [
                        'host' => 'localhost',
                        'port' => 6379,
                        'shards' => 6,
                        'db' => 1
                    ]
                ]
            ]
        ];

        $container = $this->getContainer($config);
        $this->assertTrue($container->hasDefinition('centrifugo.client'));

        $centrifugo = $container->getDefinition('centrifugo.client');
        var_dump($centrifugo->getArguments());


    }


    protected function getContainer(array $config = array(), array $thirdPartyDefinitions = array())
    {
        $container = new ContainerBuilder();
        foreach ($thirdPartyDefinitions as $id => $definition) {
            $container->setDefinition($id, $definition);
        }
        $container->getCompilerPassConfig()->setOptimizationPasses([]);
        $container->getCompilerPassConfig()->setRemovingPasses([]);

        $loader = new CentrifugoExtension();
        $loader->load($config, $container);
        $container->compile();

        return $container;
    }
}

