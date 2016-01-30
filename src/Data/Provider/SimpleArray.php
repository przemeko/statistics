<?php
namespace przemeko\Statistics\Data\Provider;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Data\Exception\EmptyDataException;

class SimpleArray implements DataProviderInterface
{
    /**
     * $array 
     * 
     * @var array
     */
    private $array;

    /**
     * __construct 
     * 
     * @param array $array 
     * @throws \przemeko\Statistics\Data\Exception\EmptyDataException
     */
    public function __construct(Array $array)
    {
        if (empty($array)) {
            throw new EmptyDataException('Array is empty');
        }

        $this->array = $array;
        if (!is_array($array[0])) {
            // we expect multivariate variables
            $this->array = [$array]; 
        }
    }

    /**
     * get 
     * 
     * @return array
     */
    public function get()
    {
        foreach ($this->array as $row) {
            yield $row;
        }
    }
}
