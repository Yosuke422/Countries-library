<?php

use PHPUnit\Framework\TestCase;

require_once 'src/scraping.php';

class CountriesTest extends TestCase
{
    public function testScrapeData()
    {
        $countries = new Countries();

        $result = $countries->scrapeData();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('France', $result);
        $this->assertArrayHasKey('Lebanon', $result);

        $this->assertIsString($result['France']);

        $this->assertMatchesRegularExpression('/^\d+(,\d+)*$/', $result['Lebanon']);
    }

    public function testScrapeDataReturnsNonEmptyArray()
    {
        $countries = new Countries();

        $result = $countries->scrapeData();

        $this->assertNotEmpty($result);
    }
}

