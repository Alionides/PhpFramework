<?php
namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
        ];

        if ('dev' === $this->getEnvironment()) {
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

//    protected function build(ContainerBuilder|\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder)
//    {
//
//    }

    protected function configureContainer(ContainerConfigurator $containerConfigurator): void
    {
        $containerConfigurator->import(__DIR__.'/../config/framework.yaml');

        // register all classes in /src/ as service
        $containerConfigurator->services()
            ->load('App\\', __DIR__.'/*')
            ->autowire()
            ->autoconfigure()
        ;

        // configure WebProfilerBundle only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $containerConfigurator->extension('web_profiler', [
                'toolbar' => env("APP_DEBUG"),
                'intercept_redirects' => false,
            ]);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // import the WebProfilerRoutes, only if the bundle is enabled
        if (isset($this->bundles['WebProfilerBundle'])) {
            $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
            $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');
        }

        // load the routes defined as PHP attributes
        // (use 'annotation' as the second argument if you define routes as annotations)
        $routes->import(__DIR__.'/Controller/', 'attribute');
    }

    // optional, to use the standard Symfony cache directory
    public function getCacheDir(): string
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    // optional, to use the standard Symfony logs directory
    public function getLogDir(): string
    {
        return __DIR__.'/../var/log';
    }
}