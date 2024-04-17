<?php

function issueQueryResponse(mixed $input, array $data): void
{
    if (empty($data)) {
        echo "No entries found for: \"$input\"\n";
    }
    foreach ($data as $row) {
        echo "\n";
        foreach ($row as $column => $datum) {
            echo "$column: $datum\n";
        }
    }
}

function issueSummaryResponse(array $valuesToSummarise): void
{
    foreach ($valuesToSummarise as $value => $count) {
        echo "\n$value: $count";
    }
    echo "\n";
}
