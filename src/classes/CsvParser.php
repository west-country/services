<?php

require_once 'CsvReader.php';

class CsvParser extends CsvReader
{
    protected string $fileLocation;
    protected array $fileAsArray;

    public function __construct(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
        $this->fileAsArray = $this->toAssocArray();
    }

    protected function toAssocArray(): array
    {
        return $this->readFile(
            function ($fileToRead) {
                while (($data = fgetcsv($fileToRead, 1000, ",")) !== false) {
                    $csvArray[] = $data;
                }
                $columns = array_shift($csvArray);
                $csvAssocArray = array_map(
                    function ($entries) use ($columns) {
                        return array_combine($columns, $entries);
                    },
                    $csvArray
                );
                return $csvAssocArray;
            }
        );
    }

    public function queryWhereColumnEqualsValue(string $columnName, mixed $value): array
    {
        $arrayOfMatches = array_filter(
            $this->fileAsArray,
            function ($row) use ($columnName, $value) {
                $entryInQueriedColumn = $row[ucfirst($columnName)];
                return strcasecmp($entryInQueriedColumn, $value) === 0;
            }
        );
        return array_values($arrayOfMatches);
    }

    protected function getExistingEntriesByColumn(string $columnName, bool $strToLower = false): array
    {
        $arrayOfColumnEntries = array_map(
            function ($row) use ($columnName, $strToLower) {
                $entry = $row[ucfirst($columnName)];
                return $strToLower ? strToLower($entry) : $entry;
            },
            $this->fileAsArray
        );
        return $arrayOfColumnEntries;
    }

    public function getEntryCountByColumn(string $columnName, bool $caseInsensitive = false): array
    {
        $columnEntries = $this->getExistingEntriesByColumn($columnName, $caseInsensitive);
        return array_count_values($columnEntries);
    }
}
