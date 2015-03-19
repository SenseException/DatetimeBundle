<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * A Kernel created for functional tests
 */
class AppKernel extends Kernel
{
    use \Budgegeria\Bundle\DatetimeBundle\Tests\Fixtures\ConfigTrait;

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
            $containerBuilder->loadFromExtension('budgegeria_datetime', $this->getConfigFixture()['budgegeria_datetime']);
        });
    }

    public function getRootDir()
    {
        return sys_get_temp_dir();
    }
}
