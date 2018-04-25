<?php

namespace przemeko\Statistics\Math\Calculator;

use przemeko\Statistics\Data\DataProviderInterface;

class Min implements CalculatorInterface
{
    private $vectors = [];

    private function step(array $row): void
    {
        $size = sizeof($row);
        for ($i = 0; $i < $size; $i++) {
            if (!isset($this->vectors[$i])) {
                $this->vectors[$i] = $row[$i];
            }

            if ($row[$i] < $this->vectors[$i]) {
                $this->vectors[$i] = $row[$i];
            }
        }
    }

    public function calculate(DataProviderInterface $dataProvider): array
    {
        $this->vectors = [];

        foreach ($dataProvider->get() as $row) {
            $this->step($row);
        }

        return $this->vectors;
    }

    public function getResult(): array
    {
        return $this->vectors;
    }

}
