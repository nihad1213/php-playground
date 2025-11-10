<?php

require __DIR__ . '/src/XMLFetcher.php';

$fetcher = new XMLFetcher();
$test = $fetcher->fetch('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
print_r($test);