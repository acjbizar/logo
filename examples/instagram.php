<?php

include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';
require_once '../src/Logo.php';

$logo = new Acj\Logo;
$logo->setHeight(540);
$logo->setWidth(540);
if(isset($_GET['save'])) $logo->save();
$logo->parse();
