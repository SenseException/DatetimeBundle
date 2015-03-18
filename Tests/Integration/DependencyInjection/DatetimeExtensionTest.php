<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\Integration\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;

/**
 * Tests for the config processing
 *
 * @codeCoverageIgnore
 */
class DatetimeExtensionTest extends PHPUnit_Framework_TestCase
{
    private $configuration;

    private $processor;

    protected function setUp()
    {
        $this->configuration = new Configuration();
        $this->processor = new Processor();
        parent::setUp();
    }

    public function testLoad()
    {
        $config = $this->processor->processConfiguration($this->configuration, $this->getConfigFixture());

        $expected = array(
            'timezone' => 'UTC',
        );

        $this->assertSame($expected, $config);
    }

    /**
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadInvalidTimezone()
    {
        $config = $this->getConfigFixture();
        $config['budgegeria_datetime']['timezone'] = null;

        $this->processor->processConfiguration($this->configuration, $config);
    }

    /**
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadMissingTimezone()
    {
        $config = $this->getConfigFixture();
        unset($config['budgegeria_datetime']['timezone']);

        $this->processor->processConfiguration($this->configuration, $config);
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
