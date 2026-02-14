<?php

require './vendor/autoload.php';

$barcode = (new Picqer\Barcode\Types\TypeCode128())->getBarcode('08134234234');

$renderer = new Picqer\Barcode\Renderers\HtmlRenderer();
echo $renderer->render($barcode);