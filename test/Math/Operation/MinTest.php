<?php
namespace przemeko\Statistics\Test\Math\Operation;

use przemeko\Statistics\Math\Operation\Min;
use przemeko\Statistics\Data\Provider\SimpleArray;

class MinTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @dataProvider minValuesDataProvider
     */
    public function testMinValues($expected, $array)
    {
        $min = new Min();
        $min->setDataProvider(new SimpleArray($array));
        $min->calculate();

        $this->assertEquals($expected, $min->getResult());
    }

    /**
    *
    * @expectedException przemeko\Statistics\Data\Exception\EmptyDataException
    */
    public function testEmptyData()
    {
        $min = new Min();
        $min->setDataProvider(new SimpleArray([]));
    }

    /**
    *
    * @expectedException przemeko\Statistics\Data\Exception\NoDataProviderException
    */
    public function testNoDataProvider()
    {
        $min = new Min();
        $min->calculate();
    }

    public function minValuesDataProvider()
    {
        return [
            [ [3,4], [[9,8],[3,4]] ],
            [ [1,2,3], [1,2,3] ],
            [ [1,2,3], [[1,2,3]] ],
            [ [0,0,0], [[1,2,3], [0,3,5],[3,0,0]] ],
            [ [-2,-1,0], [[-2,2,3], [0,3,5],[3,-1,0]] ],
            ]; 
    }
}
