<?php

use PHPUnit\Framework\TestCase;

require 'src/classes/CsvParser.php';

class CsvParserTest extends TestCase
{
    public function testQueryWhereColumnEqualsValue()
    {
        $parser = new CsvParser('./services.csv');
        $expected = [
            ['Ref' => 'BLULAB1', 'Centre' => 'Blue Sun Corp', 'Service' => 'Behaviour Modification', 'Country' => 'FR'],
            ['Ref' => 'BLULAB3', 'Centre' => 'Blue Sun R&D', 'Service' => 'Behaviour Modification', 'Country' => 'cz'],
            ['Ref' => 'BLULAB2', 'Centre' => 'Blue Sun Corp', 'Service' => 'Behaviour Modification', 'Country' => 'it']
        ];
        $actual = $parser->queryWhereColumnEqualsValue('service', 'behaviour modification');
        $this->assertSame($expected, $actual);
    }

    public function testGetEntryCountByColumnCaseInsensitive()
    {
        $parser = new CsvParser('./services.csv');
        $expected = ['fr' => 2, 'de' => 2, 'gb' => 2, 'cz' => 1, 'it' => 1, 'pt' => 1];
        $actual = $parser->getEntryCountByColumn('Country', true);
        $this->assertSame($expected, $actual);
    }

    public function testGetEntryCountByColumnCaseSensitive()
    {
        $parser = new CsvParser('./services.csv');
        $expected = ['fr' => 1, 'FR' => 1, 'de' => 1, 'gb' => 1, 'cz' => 1, 'DE' => 1, 'GB' => 1, 'it' => 1, 'pt' => 1];
        $actual = $parser->getEntryCountByColumn('Country');
        $this->assertSame($expected, $actual);
    }
}
