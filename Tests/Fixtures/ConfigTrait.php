<?php

namespace Budgegeria\Bundle\DatetimeBundle\Tests\Fixtures;

trait ConfigTrait
{
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
