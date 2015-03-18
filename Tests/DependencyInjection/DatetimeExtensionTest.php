<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Budgegeria\Bundle\DatetimeBundle\DependencyInjection\DatetimeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Prophecy\Argument;

/**
 * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\DatetimeExtension
 */
class DatetimeExtensionTest extends PHPUnit_Framework_TestCase
{
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
            ->method('setParameter')
            ->with('budgegeria_datetime.timezone', 'UTC');

        $extension = new DatetimeExtension();
        $extension->load($this->getConfigFixture(), $containerBuilder);
    }

    /**
     * @return array
     */
    private function getConfigFixture()
    {
        return array(
            'budgegeria_datetime' => array(
                'timezone' => 'UTC',
            ),
        );
    }
}
