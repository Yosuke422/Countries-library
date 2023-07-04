<?php

require_once 'vendor/autoload.php'; 

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;
require_once 'src/scraping.php'; 

$scrapedData = Countries::scrapeData();

$jsonData = json_encode($scrapedData, JSON_PRETTY_PRINT);

$file = 'data.json';
file_put_contents($file, $jsonData);

echo "Les données ont été enregistrées dans le fichier data.json.";
