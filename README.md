# statistics

## Description
Library for multivariate statistics for PHP >= 7.1. Allow large csv files.

## Usage
Array as data provider.

```php
use przemeko\Statistics\Data\Provider\SimpleArray;
use przemeko\Statistics\Math\Operation\Min;

$dataProvider = new SimpleArray([
    [1,2,3],
    [3,4,5],
]);

$min = new Min();
$min->calculate($dataProvider);
```

Use csv as data provider, and print formated matrix to cli.

```php
use przemeko\Statistics\Data\Provider\Csv;
use przemeko\Statistics\Math\Operation\Covariance;
use przemeko\Statistics\Printer\Cli;

$dataProvider = new Csv('somefile.csv');
$dataProvider->setDelimiter(",")
            ->setEnclosure('"');

$cov = new Covariance();
$cov->calculate($dataProvider);

$printer = new Cli();
$printer->output($cov->getResult());
```
