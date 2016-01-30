<?php
namespace przemeko\Statistics\Math\Operation;

use przemeko\Statistics\Data\DataContainerAbstract;
use przemeko\Statistics\Data\Exception\NoDataProviderException;
use przemeko\Statistics\Math\Operation\OperationInterface;

class Min extends DataContainerAbstract implements OperationInterface 
{
    private $vectors;

    private function step(Array $row)
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

    public function calculate()
    {
        if (!$this->dataProvider) {
            throw new NoDataProviderException('No data provider set');
        }
        
        $this->vectors = [];
        foreach ($this->dataProvider->get() as $row) {
            $this->step($row);
        }

        return $this->vectors;
    }

    public function getResult()
    {
        return $this->vectors;
    }

}
