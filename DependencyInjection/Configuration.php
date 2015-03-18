<?php

namespace Budgegeria\Bundle\DatetimeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use DateTimeZone;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('budgegeria_datetime');

        $rootNode
            ->children()
                ->scalarNode('timezone')
                    ->example('values like UTC, America/Los_Angeles, Europe/Paris')
                    ->isRequired()
                    ->validate()
                        ->ifNotInArray(DateTimeZone::listIdentifiers())
                        ->thenInvalid('"%s" is no valid timezone')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
