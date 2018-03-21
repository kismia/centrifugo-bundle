<?php

namespace Kismia\CentrifugoBundle\Tests\Client;

use Kismia\CentrifugoBundle\DependencyInjection\CentrifugoExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

class CentrifugoClientTest extends TestCase
{
    public function testClient()
    {
       $config = Yaml::parseFile(__DIR__.'/../Fixtures/config.yaml');

       $container = $this->getContainer($config);

       $client = $container->get('centrifugo.client');

       $this->assertEquals('Kismia\CentrifugoBundle\Client\CentrifugoClient', get_class($client));

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

