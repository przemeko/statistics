<?php

namespace przemeko\Statistics\Test\Data\SimpleArray;

use PHPUnit\Framework\TestCase;
use przemeko\Statistics\Data\Provider\SimpleArray;

class SimpleArrayTest extends TestCase
{
    /**
     * @expectedException przemeko\Statistics\Data\Exception\EmptyDataException
     */
    public function testEmptyData()
    {
        $dataProvider = new SimpleArray([]);
    }

}
