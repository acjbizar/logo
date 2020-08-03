<?php

define('ALPHA_DECIMALS', 1);

require_once dirname(__DIR__).'/vendor/autoload.php';

use SVG\SVG;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Embedded\SVGImage;

$letters = [];
$letters[0] = [[0,1,1,1,0],[1,0,0,0,1],[1,1,1,1,1],[1,0,0,0,1],[1,0,0,0,1]]; // A
$letters[1] = [[0,1,1,1,1],[1,0,0,0,0],[1,0,0,0,0],[1,0,0,0,0],[0,1,1,1,1]]; // C
$letters[2] = [[0,1,1,1,1],[0,0,0,0,1],[0,0,0,0,1],[1,0,0,0,1],[0,1,1,1,0]]; // J
$letters[3] = [[0,1,1,1,1],[1,0,0,0,0],[0,1,1,1,0],[0,0,0,0,1],[1,1,1,1,0]]; // s

$image = new SVG(450, 450);
$doc = $image->getDocument();

$doc->addChild(new SVGImage('https://acjs.net/images/logo-dots.png', 1, 1, 449, 449));

$letter = 0;
$r = 25;
$d = $r * 2;
$x = $r * 5;
$y = $r * 5;

draw_letter(0, $r, $x, $y);
$x += $d * 4;
draw_letter(1, $r, $x, $y);
$y += $d * 4;
draw_letter(2, $r, $x, $y);

if(isset($_GET['save'])) file_put_contents('../dist/logo.svg', $image);

header('Content-Type: image/svg+xml');

echo $image;

function draw_circle($x, $y, $r, $letter) {
    switch($letter) {
        case 0:
            $char = 'a';
            break;
        case 1:
            $char = 'c';
            break;
        case 2:
            $char = 'j';
            break;
    }

    return (new SVGCircle($x, $y, $r))
        ->setAttribute('class', $char);
}

function draw_letter($letter, $r, $x, $y) {
    global $doc, $letters;

    $d = $r * 2;
    $x -= $d * 2;
    $y -= $d * 2;

    for($j = 0; $j < 5; ++$j)
    {
        for($i = 0; $i < 5; ++$i)
        {
            if($letters[$letter][$j][$i] === 0)
            {
                $doc->addChild(draw_circle($x, $y, $r, $letter));
            } elseif($r > 5) {
                draw_letter($letter, 5, $x, $y);
            }

            $x += $d;
        }

        $y += $d;
        $x -= $d * 5;
    }
}

function get_alpha() {
    return $alpha = mt_rand(0, 5 * pow(10, ALPHA_DECIMALS - 1)) / pow(10, ALPHA_DECIMALS);
}

function get_color($letter = 0) {
    switch($letter) {
        case 0:
            $red = mt_rand(0, 255);
            $green = 255;
            $blue = 255;
            break;
        case 1:
            $red = 255;
            $green = mt_rand(0, 255);
            $blue = 255;
            break;
        case 2:
            $red = 255;
            $green = 255;
            $blue = mt_rand(0, 255);
            break;
    }

    return sprintf("#%02x%02x%02x", $red, $green, $blue);
}