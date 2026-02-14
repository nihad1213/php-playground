<?php

require './vendor/autoload.php';
$colorRed = [255, 0, 0];

// $barcode = (new Picqer\Barcode\Types\TypeCode128())->getBarcode('08134234234');

// $renderer = new Picqer\Barcode\Renderers\HtmlRenderer();
// echo $renderer->render($barcode);

$barcode = (new Picqer\Barcode\Types\TypeCode128())->getBarcode('081231723897');
$renderer = new Picqer\Barcode\Renderers\PngRenderer();
$renderer->setForegroundColor($colorRed);

file_put_contents('barcode.png', $renderer->render($barcode, $barcode->getWidth() * 3, 50));