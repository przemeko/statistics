<?php
namespace przemeko\Statistics\Data;

use przemeko\Statistics\Data\DataProviderInterface;

abstract class DataContainerAbstract
{
    protected $dataProvider;

    public function setDataProvider(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }
    
    public function getDataProvider()
    {
        return $this->dataProvider;
    }
}
