<?php
namespace przemeko\Statistics\Printer;

use przemeko\Statistics\Printer\PrinterInterface;
use ArrayObject;

class Cli implements PrinterInterface
{
    private $breakLine = "\n";

    public function output()
    {
        $args = func_get_args();
        foreach ($args as $output) {
            if (is_array($output) || $output instanceof ArrayObject ) {
                $this->outputArray($output);
            }
            else {
                echo $output;
            }
            echo $this->breakLine;
        }
    }

    private function outputArray($array)
    {
        $maxDigitsNum = 1;
        array_walk_recursive($array,function($item, $key) use (&$maxDigitsNum) {
            $len = strlen($item);
            $maxDigitsNum = $len > $maxDigitsNum ? $len : $maxDigitsNum;
        });

        $maxDigitsNum += 1;
        foreach ($array as $row) {
            if (is_array($row)) {
                foreach ($row as $col) {
                    echo sprintf("%s%s", $col, str_repeat(' ', $maxDigitsNum-strlen($col)));
                }
                echo $this->breakLine;
            }
            else {
                echo sprintf("%s ", $row);
            }

        }
        echo $this->breakLine;
    }
}
