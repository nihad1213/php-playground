<?php

declare(strict_types=1);

class XMLFetcher
{
    public function fetch(string $url): array
    {
        $xmlString = file_get_contents($url);

        if (!$xmlString) {
            throw new Exception("Failed to fetch XML from URL: $url");
        }

        $xmlObject = simplexml_load_string($xmlString);

        if ($xmlObject === false) {
            throw new Exception("Failed to parse XML from URL: $url");
        }

        $rates = [];
        
        $xmlObject->registerXPathNamespace('ecb', 'http://www.ecb.int/vocabulary/2002-08-01/eurofxref');
        
        $cubes = $xmlObject->xpath('//ecb:Cube[@currency]');
        
        if ($cubes === false || empty($cubes)) {
            throw new Exception("Failed to parse exchange rates from XML");
        }
        
        foreach ($cubes as $cube) {
            $currency = (string) $cube['currency'];
            $rate = (float) $cube['rate'];
            $rates[$currency] = $rate;
        }

        return $rates;
    }
}