<?php

require_once 'vendor/autoload.php'; // Chargement de l'autoloader de Composer

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;
require_once 'src/scraping.php'; // Assurez-vous que le chemin est correct

// Utilisation de la bibliothèque
$scrapedData = Countries::scrapeData();

// Convertir les données en format JSON
$jsonData = json_encode($scrapedData, JSON_PRETTY_PRINT);

// Enregistrer les données dans un fichier JSON
$file = 'data.json';
file_put_contents($file, $jsonData);

echo "Les données ont été enregistrées dans le fichier data.json.";
