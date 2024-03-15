<?php

require 'classes/CsvParser.php';
require 'classes/ServicesCli.php';

$servicesParser = new CsvParser("./services.csv");
$servicesCli = new ServicesCli();

//display cli options, get valid user option
$validOptionInput = $servicesCli->userOptionRequest();

if ($validOptionInput === 1) {
    $countryCode = $servicesCli->getUserCountryCode();
    $matchingRows = $servicesParser->queryWhereColumnEqualsValue("Country", $countryCode);
    $servicesCli->issueQueryResponse($countryCode, $matchingRows, $servicesParser->columnNames);
} else if ($validOptionInput === 2) {
    $existingCountryCodes = $servicesParser->getEntriesByColumn("Country", true);
    $servicesCli->issueSummaryResponse($servicesParser, $existingCountryCodes, "Country");
}

