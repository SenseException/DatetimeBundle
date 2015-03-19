<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Budgegeria\Bundle\DatetimeBundle\BudgegeriaDatetimeBundle(),
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function ($containerBuilder) {
            $containerBuilder->loadFromExtension('budgegeria_datetime', array(
                'timezone' => 'UTC',
            ));
        });
    }

    public function getRootDir()
    {
        return sys_get_temp_dir();
    }
}
