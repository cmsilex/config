<?php

namespace CMSilex\Config;

use Symfony\Component\Config\Loader\FileLoader;

class YamlFileLoader extends FileLoader
{
    public function load ($resource, $type = null)
    {
        $configValues = Yaml::parse(file_get_contents($resource));

        // ... handle the config values

        // maybe import some other resource:

        // $this->import('extra_users.yml');
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}