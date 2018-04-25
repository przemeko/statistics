<?php

namespace przemeko\Statistics\Test\Math\Operation;

use PHPUnit\Framework\TestCase;
use przemeko\Statistics\Math\Calculator\Min;
use przemeko\Statistics\Data\Provider\SimpleArray;

class MinTest extends TestCase
{
    /**
     * @dataProvider minValuesDataProvider
     */
    public function testMinValues($expected, $array)
    {
        $min = new Min();
        $min->calculate(new SimpleArray($array));

        $this->assertEquals($expected, $min->getResult());
    }

    public function minValuesDataProvider()
    {
        return [
            [[3, 4], [[9, 8], [3, 4]]],
            [[1, 2, 3], [1, 2, 3]],
            [[1, 2, 3], [[1, 2, 3]]],
            [[0, 0, 0], [[1, 2, 3], [0, 3, 5], [3, 0, 0]]],
            [[-2, -1, 0], [[-2, 2, 3], [0, 3, 5], [3, -1, 0]]],
        ];
    }
}
