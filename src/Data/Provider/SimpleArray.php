<?php
namespace przemeko\Statistics\Data\Provider;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Data\Exception\EmptyDataException;

class SimpleArray implements DataProviderInterface
{
    private $array = [];

    public function __construct(array $array)
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

    public function get(): \Generator
    {
        foreach ($this->array as $row) {
            yield $row;
        }
    }
}
