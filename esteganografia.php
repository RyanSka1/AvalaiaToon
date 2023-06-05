<?php

require __DIR__ . '/vendor/autoload.php';

$processor = new KzykHys\Steganography\Processor();
$image = $processor->encode('/path/to/image.jpg', 'Message to hide'); // jpg|png|gif

// Save image to file
$image->write('/path/to/image.png'); // png only

// Or outout image to stdout
$image->render();
