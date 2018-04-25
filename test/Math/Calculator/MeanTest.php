<?php

namespace przemeko\Statistics\Test\Math\Operation;

use PHPUnit\Framework\TestCase;
use przemeko\Statistics\Math\Calculator\Mean;
use przemeko\Statistics\Data\Provider\SimpleArray;

class MeanTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testMeanValues($expected, $array)
    {
        $mean = new Mean();
        $mean->calculate(new SimpleArray($array));

        $this->assertEquals($expected, $mean->getResult());
    }

    public function dataProvider()
    {
        return [
            [[2, 3], [[1, 1], [3, 5]]],
            [[2, 3, 4], [[1, 1, 1], [3, 5, 7]]],
        ];
    }
}
