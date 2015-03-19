<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\DependencyInjection;

use PHPUnit_Framework_TestCase;
use Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration;

/**
 * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration
 */
class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration::getConfigTreeBuilder
     *
     * @uses Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function testGetConfigTreeBuilder()
    {
        $builder = (new Configuration())->getConfigTreeBuilder();

        $tree = $builder->buildTree();

        $this->assertInstanceOf('Symfony\Component\Config\Definition\ArrayNode', $tree);
        $this->assertSame('budgegeria_datetime', $tree->getName());

        $children = $tree->getChildren();
        $this->assertCount(1, $children);

        return $children;
    }

   /**
    * @depends testGetConfigTreeBuilder
    * @covers Budgegeria\Bundle\DatetimeBundle\DependencyInjection\Configuration::getConfigTreeBuilder
    *
    * @uses Symfony\Component\Config\Definition\Builder\TreeBuilder
    */
   public function testTimezoneChild(array $children)
   {
       $this->assertArrayHasKey('timezone', $children);

       /* @var $timezone \Symfony\Component\Config\Definition\ScalarNode */
       $timezone = $children['timezone'];
       $this->assertTrue($timezone->isRequired());
       $this->assertSame('values like UTC, America/Los_Angeles, Europe/Paris', $timezone->getExample());
   }
}
