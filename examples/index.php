<?php
require_once '../vendor/autoload.php';

use przemeko\Statistics\Data\Provider\Csv;
use przemeko\Statistics\Data\Provider\SimpleArray;
use przemeko\Statistics\Math\Operation\Min;
use przemeko\Statistics\Math\Operation\Mean;
use przemeko\Statistics\Math\Operation\Covariance;
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
$min->setDataProvider($dataProvider);
$min->calculate();

$mean = new Mean();
$mean->setDataProvider($dataProvider);
$mean->calculate();

$cov = new Covariance();
$cov->setDataProvider($dataProvider);
$cov->calculate();

$printer = new Cli();
$printer->output(
    'min:', $min->getResult(),
    'mean:', $mean->getResult(),
    'cov:', $cov->getResult()
);



