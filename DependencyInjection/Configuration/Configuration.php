<?php

namespace Kismia\CentrifugoBundle\DependencyInjection\Configuration;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('centrifugo');
        $rootNode
            ->children()
                ->scalarNode('apiendpoint')->isRequired()->end()
                ->scalarNode('secret')->isRequired()->end()
                ->arrayNode('transport')
                    ->children()
                        ->arrayNode('redis')
                            ->children()
                                ->scalarNode('host')->isRequired()->end()
                                ->integerNode('port')->defaultValue(6379)->end()
                                ->integerNode('shards')->isRequired()->end()
                                ->integerNode('db')->defaultValue(0)->end()
                                ->floatNode('timeout')->defaultValue(0.3)->end()
                            ->end()
                        ->end()
                        ->arrayNode('http')
                            ->canBeUnset()

                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;

    }

}