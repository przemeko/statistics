<?php
namespace przemeko\Statistics\Math\Operation;

use przemeko\Statistics\Data\DataContainerAbstract;
use przemeko\Statistics\Data\Exception\NoDataProviderException;
use przemeko\Statistics\Math\Operation\OperationInterface;
use przemeko\Statistics\Math\Exception\LogicException;
use przemeko\Statistics\Math\Matrix;

/**
 * Covariance 
 * https://en.wikipedia.org/wiki/Covariance_matrix

 * @uses DataContainerAbstract
 * @uses OperationInterface
 */
class Covariance extends DataContainerAbstract implements OperationInterface
{
    /**
     * mean 
     * 
     * @var array
     */
    private $mean;
    /**
     * matrix 
     * 
     * @var array
     */
    private $matrix;
    /**
     * dimension 
     * 
     * @var int
     */
    private $dimension;

    /**
     * step 
     * 
     * @param array $row 
     */
    private function step(Array $row)
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
                $this->matrix[$i][$j] += ($row[$i] - $this->mean[$i])*($row[$j] - $this->mean[$j]);
                if ($i != $j) {
                    // values are the same over and under diagonal
                    $this->matrix[$j][$i] = $this->matrix[$i][$j];
                }
            }
        }
    }

    /**
     * calculate 
     * 
     * @return array
     */
    public function calculate()
    {
        if (!$this->dataProvider) {
            throw new NoDataProviderException('No data provider set');
        }

        $meanOperation = new Mean();
        $meanOperation->setDataProvider($this->getDataProvider());
        $this->mean = $meanOperation->calculate();

        if (empty($this->mean)) {
            throw new LogicException('Error with mean calculation');
        }

        $this->natrix = null;
        $this->dimension = 0;
        foreach ($this->dataProvider->get() as $row) {
            $this->step($row);
        }

        if ($this->dimension <= 1) {
            throw new LogicException(sprintf('Matrix dimension error: %s', $this->dimension));
        }

        return $this->matrix->scale(1/($this->dimension-1));
    }

    /**
     * getResult 
     * 
     * @return array
     */
    public function getResult()
    {
        return $this->matrix;
    }
}
