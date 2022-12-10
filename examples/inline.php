<?php

include $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';
require_once '../src/Logo.php';

?>
<!doctype html>
<?php

$logo = new Acj\Logo;
echo $logo;

