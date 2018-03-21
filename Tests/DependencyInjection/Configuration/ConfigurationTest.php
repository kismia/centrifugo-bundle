<?php

namespace Kismia\CentrifugoBundle\Tests\DependencyInjection\Configuration;

use Kismia\CentrifugoBundle\DependencyInjection\Configuration\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ConfigurationTest extends TestCase
{
    public function testSimpleConfig()
    {
        $config = Yaml::parseFile(__DIR__.'/../../Fixtures/config.yaml');

        $configs = $this->process($config);

        $this->assertArrayHasKey('apiendpoint', $configs);
        $this->assertArrayHasKey('secret', $configs);
        $this->assertArrayHasKey('transport', $configs);
        $this->assertArrayHasKey('redis', $configs['transport']);

    }

    /**
     * Processes an array of configurations and returns a compiled version.
     *
     * @param array $configs An array of raw configurations
     *
     * @return array A normalized array
     */
    protected function process($configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $configs);
    }
}