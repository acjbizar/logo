<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use SVG\SVG;
use SVG\Nodes\Shapes\SVGCircle;

$letters = [];
$letters[0] = [[0,1,1,1,0],[1,0,0,0,1],[1,1,1,1,1],[1,0,0,0,1],[1,0,0,0,1]]; // A
$letters[1] = [[0,1,1,1,1],[1,0,0,0,0],[1,0,0,0,0],[1,0,0,0,0],[0,1,1,1,1]]; // C
$letters[2] = [[0,1,1,1,1],[0,0,0,0,1],[0,0,0,0,1],[1,0,0,0,1],[0,1,1,1,0]]; // J
$letters[3] = [[0,1,1,1,1],[1,0,0,0,0],[0,1,1,1,0],[0,0,0,0,1],[1,1,1,1,0]]; // s

$image = new SVG(400, 400);
$doc = $image->getDocument();

$letter = 0;
$r = 25;
$d = $r * 2;
$x = $r;
$y = $r;

draw_letter(0, $x, $y);
$x += $d * 4;
draw_letter(1, $x, $y);
$y += $d * 4;
draw_letter(2, $x, $y);

header('Content-Type: image/svg+xml');

echo $image;

function draw_letter($letter, $x, $y) {
    global $doc, $letters, $r, $d;

    for($j = 0; $j < 5; ++$j)
    {
        for($i = 0; $i < 5; ++$i)
        {
            if($letters[$letter][$j][$i] === 0)
            {
                $doc->addChild(
                    (new SVGCircle($x, $y, $r))
                        ->setStyle('fill', '#ff0000')
                );
            } else {
                draw_letter2($letter, $x, $y);
            }

            $x += $d;
        }

        $y += $d;
        $x -= $d * 5;
    }
}

function draw_letter2($letter, $x, $y) {
    global $doc, $letters;

    $r = 5;
    $d = $r * 2;
    $x -= $d * 2;
    $y -= $d * 2;

    for($j = 0; $j < 5; ++$j)
    {
        for($i = 0; $i < 5; ++$i)
        {
            if($letters[$letter][$j][$i] === 0)
            {
                $doc->addChild(
                    (new SVGCircle($x, $y, $r))
                        ->setStyle('fill', '#00ff00')
                );
            } else {
                //
            }

            $x += $d;
        }

        $y += $d;
        $x -= $d * 5;
    }
}