<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Budgegeria\Bundle\DatetimeBundle\DependencyInjection\BudgegeriaDatetimeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\DatetimeExtension
 */
class BudgegeriaDatetimeExtensionTest extends PHPUnit_Framework_TestCase
{
    use \Budgegeria\Bundle\DatetimeBundle\Tests\Fixtures\ConfigTrait;

    /**
     * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\DatetimeExtension::load
     *
     * @uses Symfony\Component\Config\Definition\Processor
     * @uses Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration
     * @uses Symfony\Component\DependencyInjection\Loader\XmlFileLoader
     * @uses Symfony\Component\Config\FileLocator
     */
    public function testLoad()
    {
        $containerBuilder = $this->getMockBuilder(ContainerBuilder::CLASS)
            ->disableOriginalConstructor()
            ->getMock();
        $containerBuilder->expects($this->once())
            ->method('getParameterBag')
            ->will($this->returnValue($this->getMock(ParameterBag::CLASS)));
        $containerBuilder->expects($this->once())
            ->method('setParameter')
            ->with('budgegeria_datetime.timezone', 'UTC');

        $extension = new BudgegeriaDatetimeExtension();
        $extension->load($this->getConfigFixture(), $containerBuilder);
    }
}
