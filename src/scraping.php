<?php

require_once 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

class Countries
{
    /**
     * Scraper les données du site et les retourner sous forme de tableau associatif.
     *
     *  @return array<int|string, string>
     */
    public static function scrapeData(): array
    {
        $html = file_get_contents('https://www.worldometers.info/world-population/population-by-country/');
        $crawler = new Crawler();
        $crawler->addHtmlContent((string)$html);

        $countries = $crawler->filter('table tbody tr td:nth-child(2) a')->extract(['_text']);
        $populations = $crawler->filter('table tbody tr td:nth-child(3)')->extract(['_text']);

        $data = [];
        foreach ($countries as $index => $country) {
            $data[$country] = $populations[$index];
        }

        return $data;
    }
}

    $countriesData = Countries::scrapeData();

foreach ($countriesData as $country => $population) {
    echo "Pays : " . $country . ", Population : " . $population . "<br>";
}

