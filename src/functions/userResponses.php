<?php

function issueQueryResponse(mixed $input, array $data, array $columnNames): void {
    if (empty($data)) {
        echo "No entries found for: \"$input\"\n";
    }
    foreach ($data as $row) {
        echo "\n";
        foreach ($row as $column => $datum) {
            echo "$columnNames[$column]: $datum\n";
        }
    }
}

function issueSummaryResponse(CsvParser $csvParser, array $valuesToSummarise, string $columnName): void {
    foreach ($valuesToSummarise as $value) {
        $numOfRows = count($csvParser->queryWhereColumnEqualsValue($columnName, $value));
        echo "\n$value: $numOfRows";
    }
    echo "\n";
}