<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DateTimeZone;
use DateTime;
use DateTimeImmutable;

/**
 * Behaviour check for default services
 *
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
        $this->assertSame($this->container->get('budgegeria_datetime.timezone'), $timezone);
    }

    public function testDefaultLazyDateTime()
    {
        $datetime = $this->container->get('budgegeria_datetime.datetime');

        $this->assertInstanceOf(DateTime::CLASS, $datetime);
        $this->assertNotSame(DateTime::CLASS, get_class($datetime));
        $this->assertNotSame($this->container->get('budgegeria_datetime.datetime'), $datetime);

        $compareDateTime = new DateTime(
            $this->container->getParameter('budgegeria_datetime.start_date'),
            $this->container->get('budgegeria_datetime.timezone')
        );

        sleep(1);

        // lazyload instance from proxy
        $this->assertGreaterThan($compareDateTime->getTimestamp(), $datetime->getTimestamp());
    }

    public function testGlobalDateTime()
    {
        $datetime = $this->container->get('budgegeria_datetime.datetime_global');

        $this->assertInstanceOf(DateTime::CLASS, $datetime);
        $this->assertSame($this->container->get('budgegeria_datetime.datetime_global'), $datetime);
        $this->assertSame($this->container->get('budgegeria_datetime.datetime_global')->getTimestamp(), $datetime->getTimestamp());
    }

    public function testDateTimeImmutable()
    {
        $datetime = $this->container->get('budgegeria_datetime.datetime_immutable');

        $this->assertInstanceOf(DateTimeImmutable::CLASS, $datetime);
        $this->assertNotSame($this->container->get('budgegeria_datetime.datetime_immutable'), $datetime);
        $this->assertNotSame($datetime->setTimestamp($datetime->getTimestamp()), $datetime);
    }
}
