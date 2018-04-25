<?php

namespace przemeko\Statistics\Test\Math\Operation;

use PHPUnit\Framework\TestCase;
use przemeko\Statistics\Math\Calculator\Covariance;
use przemeko\Statistics\Data\Provider\SimpleArray;

class CovarianceTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCovarianceValues($expected, $array)
    {
        $covariance = new Covariance();
        $covariance->calculate(new SimpleArray($array));

        $this->assertEquals($expected, (array)$covariance->getResult());
    }

    public function dataProvider()
    {
        $array = [
            [1, 6, 9],
            [4, 5, 5],
            [7, 4, 1]
        ];

        $expected = [
            [9, -3, -12],
            [-3, 1, 4],
            [-12, 4, 16]
        ];


        return [
            [$expected, $array],
        ];
    }
}
