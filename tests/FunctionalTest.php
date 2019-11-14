<?php

namespace Amps\LoremIpsumBundle\Tests;

use Amps\LoremIpsumBundle\KnpUIpsum;
use Amps\LoremIpsumBundle\AmpsLoremIpsumBundle;
use Amps\LoremIpsumBundle\WordProviderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new AmpsLoremIpsumTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $ipsum = $container->get('amps_lorem_ipsum.knpu_ipsum');
        $this->assertInstanceOf(KnpUIpsum::class, $ipsum);
        $this->assertInternalType('string', $ipsum->getParagraphs());
    }
}

class AmpsLoremIpsumTestingKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new AmpsLoremIpsumBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function(ContainerBuilder $container) {
            $container->register('stub_word_list', StubWordList::class)
                ->addTag('amps_ipsum_word_provider');
        });
    }

    public function getCacheDir()
    {
        return __DIR__.'/../../var/cache/test/'.spl_object_hash($this);
    }

}

class StubWordList implements WordProviderInterface
{
    public function getWordList(): array
    {
        return ['stub', 'stub2'];
    }
}
