<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use SVG\SVG;
use SVG\Nodes\Shapes\SVGCircle;

$image = new SVG(100, 100);
$doc = $image->getDocument();

$doc->addChild(
    (new SVGCircle(50, 50, 20))
        ->setStyle('fill', 'none')
        ->setStyle('stroke', '#0F0')
        ->setStyle('stroke-width', '2px')
);

header('Content-Type: image/svg+xml');

echo $image;
