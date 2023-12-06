<?php

/**
 * Copyright (c) 2018. picsavary@icloud.com
 *
 */

declare(strict_types=1);

namespace Amps\LoremIpsumBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WordProviderCompilerPass implements CompilerPassInterface
{
    // The correct place for any logic that needs
    // to operate on the entire container, is a compiler pass
    // NOTE in extension class, the early container is empty
    public function process(ContainerBuilder $container) : void
    {
        $definition = $container->getDefinition('amps_lorem_ipsum.knpu_ipsum');
        $references = [];
        foreach ($container->findTaggedServiceIds('amps_ipsum_word_provider') as $id => $tags) {
            $references[] = new Reference($id);
        }
        $definition->setArgument(0, $references);
        // ARGUMENTS[1] AND [2] IN EXTENSION CLASS
    }
}