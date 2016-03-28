<?php

namespace CMSilex\Loaders;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlFileLoader extends FileLoader
{
    public function load ($resource, $type = null)
    {
        $resolved = $this->getLocator()->locate($resource);
        $configValues = Yaml::parse(file_get_contents($resolved));
       return $configValues;
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}