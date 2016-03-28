<?php

namespace CMSilex\Config;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['config'] = $app->share(function () use ($app) {
            $configDirectories = array(__DIR__.'/app/config');

            $locator = new FileLocator($configDirectories);

            $loaderResolver = new LoaderResolver(array(new YamlFileLoader($locator)));

            $delegatingLoader = new DelegatingLoader($loaderResolver);

            $delegatingLoader->load(__DIR__.'/users.yml');
        });
    }

    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}