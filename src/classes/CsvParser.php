<?php

class CsvParser
{
    public string $fileLocation;
    public array $fileAsArray;
    public array $columnNames;

    public function __construct(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
        $this->fileAsArray = $this->toArray();
        $this->columnNames = $this->fileAsArray[0];
    }

    public function convertCsvToArray($fileToRead): array
    {
        while (($data = fgetcsv($fileToRead, 1000, ",")) !== false) {
            $csvArray[] = $data;
        }
        return $csvArray;
    }

    public function toArray(): array
    {
        $csvArray = $this->readFile('convertCsvToArray');
        return $csvArray;
    }

    public function readFile(string $callbackForReadingFile): mixed
    {
        if (($openFile = fopen($this->fileLocation, "r")) !== false) {

            $parsedData = $this->{$callbackForReadingFile}($openFile);

            fclose($openFile);
        }
        return $parsedData;
    }

    public function queryWhereColumnEqualsValue(string $columnName, mixed $value)
    {
        $columnIndex = $this->getColumnIndex($columnName);
        $value = strtolower($value);

        $arrayOfMatches = array_filter($this->fileAsArray, function ($row) use ($columnIndex, $value) {
            $entryInRelevantColumn = $row[$columnIndex];
            if (is_string($entryInRelevantColumn)) {
                $entryInRelevantColumn = strtolower($entryInRelevantColumn);
            }
            if ($entryInRelevantColumn === $value) {
                return true;
            } else {
                return false;
            }
        });

        return $arrayOfMatches;
    }

    public function getColumnIndex(string $columnName): string
    {
        return array_search($columnName, $this->columnNames);
    }

    public function getEntriesByColumn(string $columnName, bool $strToLower = false): array
    {
        $columnIndex = $this->getColumnIndex($columnName);
        $fileArrayExTitleRow = $this->fileAsArray;
        array_shift($fileArrayExTitleRow);
        $arrayOfCountryEntries = array_map(
            function ($row) use ($columnIndex, $strToLower) {
                return $strToLower ? strToLower($row[$columnIndex]) : $row[$columnIndex];
            },
            $fileArrayExTitleRow
        );
        return array_unique($arrayOfCountryEntries);
    }
}

?>