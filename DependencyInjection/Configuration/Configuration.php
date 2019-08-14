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
                                ->scalarNode('port')->defaultValue(6379)->end()
                                ->scalarNode('shards')->isRequired()->end()
                                ->scalarNode('db')->defaultValue(0)->end()
                                ->scalarNode('timeout')->defaultValue(0.3)->end()
                            ->end()
                        ->end()
                        ->arrayNode('http')
                            ->children()
                                ->scalarNode(78)->end()
                                ->scalarNode(13)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;

    }

}