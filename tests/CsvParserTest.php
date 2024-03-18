<?php

use PHPUnit\Framework\TestCase;
require 'src/classes/CsvParser.php';

class CsvParserTest extends TestCase
{
    public function testInvalidFilePath()
    {
        $invalidFilePath = 'invalid.csv';
        $this->expectException(Exception::class);
        $parser = new CsvParser($invalidFilePath);
    }
}
