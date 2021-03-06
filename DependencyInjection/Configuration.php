<?php

namespace Dehy\ChoicesJsEntityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('choices_js_entity');
        $rootNode = \method_exists($treeBuilder, 'getRootNode')
            ? $treeBuilder->getRootNode()
            : $treeBuilder->root('choices_js_entity');

        $rootNode
            ->children()
            ->scalarNode('minimum_input_length')
            ->defaultValue(1)
            ->end()
            ->scalarNode('scroll')
            ->defaultFalse()
            ->end()
            ->scalarNode('page_limit')
            ->defaultValue(10)
            ->end()
            ->scalarNode('allow_clear')
            ->defaultFalse()
            ->end()
            ->arrayNode('allow_add')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('enabled')
            ->defaultFalse()
            ->end()
            ->scalarNode('new_tag_text')
            ->defaultValue(' (NEW)')
            ->end()
            ->scalarNode('new_tag_prefix')
            ->defaultValue('__')
            ->end()
            ->scalarNode('tag_separators')
            ->defaultValue('[",", " "]')
            ->end()
            ->end()
            ->end()
            ->scalarNode('delay')
            ->defaultValue(250)
            ->end()
            ->scalarNode('language')
            ->defaultValue('en')
            ->end()
            ->scalarNode('cache')
            ->defaultTrue()
            ->end()
            // default to 1ms for backwards compatibility for older versions where 'cache' is true but the
            // user is not aware of the updated caching feature. This way the cache will, by default, not
            // be very effective. Realistically this should be like 60000ms (60 seconds).
            ->scalarNode('cache_timeout')
            ->defaultValue(1)
            ->end()
            ->scalarNode('width')
            ->defaultNull()
            ->end()
            ->scalarNode('object_manager')
            ->defaultValue(1)
            ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
