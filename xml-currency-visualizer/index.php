<?php

require __DIR__ . '/src/XMLFetcher.php';
require __DIR__ . '/src/GraphDrawer.php';

try {
    $fetcher = new XMLFetcher();
    $rates = $fetcher->fetch('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
    
    $drawer = new GraphDrawer();
    $drawer->draw($rates, __DIR__ . '/output/exchange_rates.png');
    
    echo "Graph generated successfully at output/exchange_rates.png<br>";
    echo '<img src="output/exchange_rates.png" alt="Exchange Rates Graph">';
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}