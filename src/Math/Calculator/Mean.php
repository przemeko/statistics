<?php

namespace przemeko\Statistics\Math\Calculator;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Math\Exception\LogicException;

class Mean implements CalculatorInterface
{
    private $vectors = [];
    private $dimension = 0;

    private function step(array $row): void
    {
        $this->dimension++;
        $size = sizeof($row);
        for ($i = 0; $i < $size; $i++) {
            if (!isset($this->vectors[$i])) {
                $this->vectors[$i] = 0;
            }

            $this->vectors[$i] += $row[$i];
        }
    }

    /**
     * @throws LogicException
     */
    public function calculate(DataProviderInterface $dataProvider): array
    {
        $this->dimension = 0;
        $this->vectors = [];
        foreach ($dataProvider->get() as $row) {
            $this->step($row);
        }

        if ($this->dimension == 0) {
            throw new LogicException('Dimension of vector must be greater than 0');
        }

        foreach ($this->vectors as $key => $value) {
            $this->vectors[$key] = $value / $this->dimension;
        }

        return $this->vectors;
    }

    public function getResult(): array
    {
        return $this->vectors;
    }
}
