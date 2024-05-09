<?php
require_once "autoload.php";
$modelo = new Lightning();

$modelo->deletelist();

$modelo->importarLambs('lighting.csv');


?>