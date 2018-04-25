<?php

namespace przemeko\Statistics\Math;

use przemeko\Statistics\Math\Exception\OutOfRangeException;
use przemeko\Statistics\Math\Exception\LogicException;
use ArrayObject;

class Matrix extends ArrayObject
{
    public function __construct(int $rows, int $cols, float $defaultValue = 0)
    {
        parent::__construct();

        $this->generate($rows, $cols, $defaultValue);
    }

    private function generate(int $rows, int $cols, float $defaultValue = 0): void
    {
        for ($i = 0; $i < $rows; $i++) {
            $this[$i] = [];
            for ($j = 0; $j < $cols; $j++) {
                $this[$i][$j] = $defaultValue;
            }
        }
    }

    /**
     * @throws LogicException
     */
    public function scale(float $scalar): Matrix
    {
        if (!is_numeric($scalar)) {
            throw new LogicException(sprintf('%s is not number', $scalar));
        }

        array_walk_recursive($this, function (&$item, $key) use ($scalar) {
            $item = $item * $scalar;
        });

        return $this;
    }

    /**
     * @throws OutOfRangeException
     */
    public function get(int $row, int $col): float
    {
        if (!isset($this[$row][$col])) {
            throw new OutOfRangeException(sprintf('Out of range: row: %s, col: %s', $row, $col));
        }

        return $this[$row][$col];
    }
}
