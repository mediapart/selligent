<?php

namespace Mediapart\Selligent;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class SelligentConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('selligent');

        $rootNode
          ->children()
            ->scalarNode('login')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('password')
              ->isRequired()
              ->cannotBeEmpty()
            ->end()
            ->scalarNode('namespace')
                ->defaultValue('http://tempuri.org/')
            ->end()
            ->scalarNode('wsdl')
              ->isRequired()
              ->cannotBeEmpty()
            ->end()
            ->scalarNode('list')
                ->isRequired()
            ->end()
            ->arrayNode('options')
                ->children()
                    ->arrayNode('classmap')
                        ->isRequired()
                    ->end()
                ->end()
            ->end()
          ->end()
        ;

        return $treeBuilder;
    }
}
