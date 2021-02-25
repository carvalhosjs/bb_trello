<?php
require_once __DIR__ . '/vendor/autoload.php';
use BBTrello\Core\Trello;

$key = "576605ac4bfcbc3f3978359f8afb5c04";
$token= "e1a6812eed64b06672f38d8ec8f64b51ca3aee7fc95fe2e788bc82b80a0801aa";
$trelo = new Trello($key, $token);

$file = $_FILES['file'];

$a = $trelo->addAttachmentsInCard("603699e51a43551a9745549f", $file);



var_dump($a);