<?php
require_once '../vendor/autoload.php';

use przemeko\Statistics\Data\Provider\Csv;
use przemeko\Statistics\Data\Provider\SimpleArray;
use przemeko\Statistics\Math\Calculator\Min;
use przemeko\Statistics\Math\Calculator\Mean;
use przemeko\Statistics\Math\Calculator\Covariance;
use przemeko\Statistics\Printer\Cli;

$dataProvider = new Csv('data.csv');
$dataProvider->setDelimiter(",")
    ->setEnclosure('"');
/*
$dataProvider = new SimpleArray([
    [1,2,3],
    [3,4,5],
]);
*/

$min = new Min();
$min->calculate($dataProvider);

$mean = new Mean();
$mean->calculate($dataProvider);

$cov = new Covariance();
$cov->calculate($dataProvider);

$printer = new Cli();
$printer->output(
    'min:', $min->getResult(),
    'mean:', $mean->getResult(),
    'cov:', $cov->getResult()
);
