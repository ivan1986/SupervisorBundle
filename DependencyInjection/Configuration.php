<?php

namespace Ivan1986\SupervisorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('supervisor');
        $rootNode->children()
                ->scalarNode('name')->defaultValue('symfony2')->end()
            ->end();
        return $treeBuilder;
    }
}
