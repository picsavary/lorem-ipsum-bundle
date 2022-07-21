<?php

/**
 * Last modified: 11/11/2019 00:26
 *
 * Copyright (c) 2019. picsavary@icloud.com
 *
 */

declare(strict_types=1);

namespace Amps\LoremIpsumBundle;

use Amps\LoremIpsumBundle\DependencyInjection\Compiler\WordProviderCompilerPass;
use Amps\LoremIpsumBundle\DependencyInjection\AmpsLoremIpsumExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class AmpsLoremIpsumBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new WordProviderCompilerPass());
    }

    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        // This does the same thing as the parent method getContainerExtension(),
        // but without that sanity check.
        if (null === $this->extension) {
            $this->extension = new AmpsLoremIpsumExtension();
        }

        return $this->extension;
    }
}
