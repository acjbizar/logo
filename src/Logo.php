<?php

declare(strict_types = 1);

namespace Acj;

use SVG\SVG;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Embedded\SVGImage;

class Logo {
    const ALPHA_DECIMALS = 1;

    public $letters = [];

    public function __construct() {
        $this->letters[0] = [[0,1,1,1,0],[1,0,0,0,1],[1,1,1,1,1],[1,0,0,0,1],[1,0,0,0,1]]; // A
        $this->letters[1] = [[0,1,1,1,1],[1,0,0,0,0],[1,0,0,0,0],[1,0,0,0,0],[0,1,1,1,1]]; // C
        $this->letters[2] = [[0,1,1,1,1],[0,0,0,0,1],[0,0,0,0,1],[1,0,0,0,1],[0,1,1,1,0]]; // J
        $this->letters[3] = [[0,1,1,1,1],[1,0,0,0,0],[0,1,1,1,0],[0,0,0,0,1],[1,1,1,1,0]]; // s

        $this->image = new SVG(450, 450);
        $this->doc = $this->image->getDocument();
        $this->doc->setAttribute('class', 'logo--acjs');

        $this->doc->addChild(new SVGImage('https://acjs.net/images/logo-dots.png', 1, 1, 449, 449));

        $letter = 0;
        $r = 25;
        $d = $r * 2;
        $x = $r * 5;
        $y = $r * 5;

        $this->drawLetter(0, $r, $x, $y);
        $x += $d * 4;
        $this->drawLetter(1, $r, $x, $y);
        $y += $d * 4;
        $this->drawLetter(2, $r, $x, $y);
    }

    public function drawCircle($x, $y, $r, $letter): SVGCircle
    {
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

    public function drawLetter($letter, $r, $x, $y) {
        $d = $r * 2;
        $x -= $d * 2;
        $y -= $d * 2;

        for($j = 0; $j < 5; ++$j)
        {
            for($i = 0; $i < 5; ++$i)
            {
                if($this->letters[$letter][$j][$i] === 0)
                {
                    $this->doc->addChild($this->drawCircle($x, $y, $r, $letter));
                } elseif($r > 5) {
                    $this->drawLetter($letter, 5, $x, $y);
                }

                $x += $d;
            }

            $y += $d;
            $x -= $d * 5;
        }
    }

    public function getAlpha() {
        return $alpha = mt_rand(0, 5 * pow(10, self::ALPHA_DECIMALS - 1)) / pow(10, self::ALPHA_DECIMALS);
    }

    public function getColor($letter = 0): string
    {
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

    public function parse() {
        header('Content-Type: image/svg+xml');

        echo $this->image;
    }

    public function save($filename = '../dist/logo.svg') {
        file_put_contents($filename, $this->image);
    }
}
