<?php
/**
 * Last modified: 13/11/2019 00:44
 *
 * Copyright (c) 2019. picsavary@icloud.com
 *
 */

namespace Amps\LoremIpsumBundle\Tests\Controller;
use Amps\LoremIpsumBundle\AmpsLoremIpsumBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
class IpsumApiControllerTest extends TestCase
{
    public function testIndex()
    {
        $kernel = new AmpsLoremIpsumControllerKernel();
        $client = new Client($kernel);
        $client->request('GET', '/api/');
        // var_dump($client->getResponse()->getContent());
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
class AmpsLoremIpsumControllerKernel extends Kernel
{
    use MicroKernelTrait;
    public function __construct()
    {
        parent::__construct('test', true);
    }
    public function registerBundles()
    {
        return [
            new AmpsLoremIpsumBundle(),
            new FrameworkBundle()
        ];
    }
    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__.'/../../src/Resources/config/routes.xml', '/api');
    }
    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension(
            'framework',
            [
                'secret' => 'ANYTHING',
            ]
        );
    }
    public function getCacheDir()
    {
        return __DIR__.'/../../var/cache/test/'.spl_object_hash($this);
    }

}
