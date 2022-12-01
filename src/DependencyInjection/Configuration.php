<?php

/**
 * Last modified: 12/11/2019 15:45
 * Copyright (c) 2019. picsavary@icloud.com
 */

declare(strict_types=1);

namespace Amps\LoremIpsumBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('amps_lorem_ipsum');
        if (method_exists($treeBuilder, 'getRootNode' )){
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('amps_lorem_ipsum');

        }
        $rootNode
            ->children()
                ->booleanNode('unicorns_are_real')->defaultTrue()->info('Whether or not you believe in unicorns')->end()
                ->integerNode('min_sunshine')->defaultValue(3)->info('How much do you like sunshine?')->end()
                // ->scalarNode('word_provider')->defaultNull()->end()
            ->end()
        ;
        return $treeBuilder;
    }
}