<?php

/**
 * Last modified: 11/11/2019 21:14
 *
 * Copyright (c) 2019. picsavary@icloud.com
 *
 */

declare(strict_types=1);

namespace Amps\LoremIpsumBundle\DependencyInjection;

use Amps\LoremIpsumBundle\WordProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class AmpsLoremIpsumExtension
 * @package Amps\LoremIpsumBundle\DependencyInjection
 */
class AmpsLoremIpsumExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        // Symfony passes us an empty container builder,
        // and then merges it into the real one later
        // The correct place for any logic that needs
        // to operate early on the entire container, is a compiler pass
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('amps_lorem_ipsum.knpu_ipsum');
        $definition->setArgument(1, $config['unicorns_are_real']);
        $definition->setArgument(2, $config['min_sunshine']);
        // TO AUTO TAG EACH CLASS EXTENDING WORDPROVIDERINTERFACE,
        // EG THE ONES IN THE USER CODE
        // ELSE, THE USER SHOULD HAVE TO TAG ITS CLASS IN ITS SERVICES.YAML FILE
        $container->registerForAutoconfiguration(WordProviderInterface::class)
            ->addTag('amps_ipsum_word_provider');
    }
    public function getAlias(): string
    {
        return 'amps_lorem_ipsum';
    }
}

