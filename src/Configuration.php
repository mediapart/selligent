<?php

/**
 * This file is part of the Mediapart Selligent Client API
 *
 * CC BY-NC-SA <https://github.com/mediapart/selligent>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mediapart\Selligent;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class Configuration
 * @package Mediapart\Selligent
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Define configTree
     * @return TreeBuilder
     */
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
            ->arrayNode('options')
                ->children()
                    ->arrayNode('classmap')
                        ->isRequired()
                        ->prototype('scalar')
                    ->end()
                ->end()
            ->end()
          ->end()
        ;

        return $treeBuilder;
    }
}
