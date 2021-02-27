<?php

require_once '../src/class.logo.php';

$logo = new ACJs\Logo;
$logo->setFunction('letter', 'a', ['fill' => 'red']);
$logo->setFunction('letter', 'c', ['fill' => 'lime']);
$logo->setFunction('letter', 'j', ['fill' => 'blue']);
if(isset($_GET['save'])) $logo->save();
$logo->parse();
