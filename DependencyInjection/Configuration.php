<?php


declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * DI-configuration for bundle
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('fantestic_cest_manager');
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('twitter')
                    ->children()
                        ->integerNode('client_id')->end()
                        ->scalarNode('client_secret')->end()
                    ->end()
                ->end() // twitter
            ->end()
        ;

        return $treeBuilder;
    }
}
