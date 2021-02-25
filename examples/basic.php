<?php

require_once '../src/class.logo.php';

$logo = new Logo;
if(isset($_GET['save'])) $logo->save();
$logo->parse();
