<?php

use PHPUnit\Framework\TestCase;
require_once 'src/classes/CsvReader.php';

class CsvReaderTest extends TestCase
{
    public function testInvalidFilePath()
    {
        $callable = fn() => 1;
        $invalidFilePath = 'invalid.csv';
        $reader = new CsvReader($invalidFilePath);
        $this->expectException(RunTimeException::class);
        $reader->readFile($callable);
    }
}
