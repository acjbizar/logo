<?php

include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';
require_once '../src/Logo.php';

$logo = new Acj\Logo;
if(isset($_GET['save'])) $logo->save();
$logo->parse();
