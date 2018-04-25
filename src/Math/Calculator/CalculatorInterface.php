<?php

namespace przemeko\Statistics\Math\Calculator;

use przemeko\Statistics\Data\DataProviderInterface;

interface CalculatorInterface
{
    public function calculate(DataProviderInterface $dataProvider);

    public function getResult();
}
