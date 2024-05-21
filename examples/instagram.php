<?php

include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';
require_once realpath('../src/Logo.php');

$logo = new Acj\Logo;
$logo->setHeight(540);
$logo->setWidth(540);

$png = $logo->toRasterImage();

header('Content-Type: image/png');

imagepng($png);
imagedestroy($png);

//if(isset($_GET['save'])) $logo->save();
//$logo->parse();
