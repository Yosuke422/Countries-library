<?php

require_once 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

class Countries
{
    /**
     * Scraper les données du site et les retourner sous forme de tableau associatif.
     *
     * @return array<string, array<string, string>>
     */
    public static function scrapeData(): array
    {
        $html = file_get_contents('https://www.worldometers.info/world-population/population-by-country/');
        $crawler = new Crawler();
        $crawler->addHtmlContent((string)$html);

        $countries = $crawler->filter('table tbody tr')->each(function (Crawler $node, $i) {
            $countryName = $node->filter('td:nth-child(2) a')->text();
            $population = $node->filter('td:nth-child(3)')->text();
            $landArea = $node->filter('td:nth-child(7)')->text();

            return [
                'population' => $population,
                'land_area' => $landArea,
            ];
        });

        $data = [];
        foreach ($countries as $index => $countryData) {
            $countryName = $crawler->filter('table tbody tr td:nth-child(2) a')->eq($index)->text();
            $data[$countryName] = $countryData;
        }

        return $data;
    }
}

$countriesData = Countries::scrapeData();

foreach ($countriesData as $country => $data) {
    echo "Pays : " . $country . "<br>";
    echo "Population : " . $data['population'] . "<br>";
    echo "Superficie terrestre : " . $data['land_area'] . "<br><br>";
}
