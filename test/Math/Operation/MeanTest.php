<?php
namespace przemeko\Statistics\Test\Math\Operation;

use przemeko\Statistics\Math\Operation\Mean;
use przemeko\Statistics\Data\Provider\SimpleArray;

class MeanTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @dataProvider dataProvider
     */
    public function testMeanValues($expected, $array)
    {
        $min = new Mean();
        $min->setDataProvider(new SimpleArray($array));
        $min->calculate();

        $this->assertEquals($expected, $min->getResult());
    }

    public function dataProvider()
    {
        return [
            [ [2,3], [[1,1],[3,5]] ],
            [ [2,3,4], [[1,1,1],[3,5,7]] ],
            ]; 
    }
}
