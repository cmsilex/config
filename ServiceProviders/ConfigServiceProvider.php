<?php

namespace CMSilex\ServiceProviders;

use CMSilex\Configuration;
use CMSilex\Loaders\YamlFileLoader;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;

class ConfigServiceProvider implements ServiceProviderInterface
{

    public function register(Container $container)
    {
        $container['config'] = function () {
            $configDirectories = ['../config/', './config/'];

            $locator = new FileLocator($configDirectories);

            $loaderResolver = new LoaderResolver([new YamlFileLoader($locator)]);

            $delegatingLoader = new DelegatingLoader($loaderResolver);

            $something = $delegatingLoader->load('config.yml');

            $processor = new Processor();
            $configuration = new Configuration();
            $processedConfiguration = $processor->processConfiguration(
                $configuration,
                [$something]
            );

            return $processedConfiguration;
        };
    }
}