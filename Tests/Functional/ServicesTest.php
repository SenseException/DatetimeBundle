<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DateTimeZone;

/**
 * @codeCoverageIgnore
 */
class ServicesTest extends WebTestCase
{
    private $container;

    protected function setUp()
    {
        parent::setUp();

        static::bootKernel();

        $this->container = static::$kernel->getContainer();
    }

    public function testDefaultTimezone()
    {
        $timezone = $this->container->get('budgegeria_datetime.timezone');

        $this->assertInstanceOf(DateTimeZone::CLASS, $timezone);
        $this->assertSame('UTC', $timezone->getName());
    }
}
