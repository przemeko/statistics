<?php
namespace przemeko\Statistics\Math\Operation;

use przemeko\Statistics\Data\DataContainerAbstract;
use przemeko\Statistics\Data\Exception\NoDataProviderException;
use przemeko\Statistics\Math\Operation\OperationInterface;
use przemeko\Statistics\Math\Exception\LogicException;

class Mean extends DataContainerAbstract implements OperationInterface
{
    private $vectors;
    private $dimension;

    private function step(Array $row)
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

    public function calculate()
    {
        if (!$this->dataProvider) {
            throw new NoDataProviderException('No data provider set');
        }

        $this->dimension = 0;
        $this->vectors = [];
        foreach ($this->dataProvider->get() as $row) {
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

    public function getResult()
    {
        return $this->vectors;
    }
}
