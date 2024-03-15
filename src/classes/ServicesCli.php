<?php

class ServicesCli
{
    const USER_OPTIONS_LIST = "OPTIONS: \n1. Query data by country code.\n2. Summarise data by country code.\n";
    const COUNTRY_COLUMN = "Country";

    public function getUserOption()
    {
        echo self::USER_OPTIONS_LIST;
        return intval(readline("Please enter option number: "));
    }

    public function userOptionRequest()
    {
        $userOption = $this->getUserOption();
        while ($userOption !== 1 && $userOption !== 2) {
            echo "Invalid option\n";
            $userOption = $this->getUserOption();
            break;
        }
        return $userOption;
    }

    public function getUserCountryCode() 
    {
        return strtolower(readline("Enter country code: "));
    }

    public function issueQueryResponse($input, $data, $columnNames)
    {
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

    public function issueSummaryResponse(CsvParser $csvParser, $valuesToSummarise, $columnName)
    {
        foreach ($valuesToSummarise as $value) {
            $numOfRows = count($csvParser->queryWhereColumnEqualsValue($columnName, $value));
            echo "\n$value: $numOfRows";
        }
        echo "\n";
    }
}

?>