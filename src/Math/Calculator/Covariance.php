<?php

namespace przemeko\Statistics\Math\Calculator;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Math\Exception\LogicException;
use przemeko\Statistics\Math\Matrix;

/**
 * Covariance
 * https://en.wikipedia.org/wiki/Covariance_matrix
 * @uses DataProviderTrait
 * @uses CalculatorInterface
 */
class Covariance implements CalculatorInterface
{
    /**
     * @var array
     */
    private $mean;

    /**
     * @var Matrix
     */
    private $matrix;

    /**
     * @var int
     */
    private $dimension;

    private function step(array $row): void
    {
        $size = sizeof($row);
        if (!$this->matrix) {
            $this->matrix = new Matrix($size, $size);
        }

        if (!$this->dimension) {
            $this->dimension = $size;
        }

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                $this->matrix[$i][$j] += ($row[$i] - $this->mean[$i]) * ($row[$j] - $this->mean[$j]);
                if ($i != $j) {
                    // values are the same over and under diagonal
                    $this->matrix[$j][$i] = $this->matrix[$i][$j];
                }
            }
        }
    }

    /**
     * @throws LogicException
     */
    public function calculate(DataProviderInterface $dataProvider): Matrix
    {
        $meanCalculator = new Mean();
        $this->mean = $meanCalculator->calculate($dataProvider);

        if (empty($this->mean)) {
            throw new LogicException('Error with mean calculation');
        }

        $this->matrix = null;
        $this->dimension = 0;
        foreach ($dataProvider->get() as $row) {
            $this->step($row);
        }

        if ($this->dimension <= 1) {
            throw new LogicException(sprintf('Matrix dimension error: %s', $this->dimension));
        }

        return $this->matrix->scale(1 / ($this->dimension - 1));
    }

    public function getResult(): Matrix
    {
        return $this->matrix;
    }
}
