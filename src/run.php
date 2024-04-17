<?php

require 'classes/CsvParser.php';
require 'functions/userInput.php';
require 'functions/userResponses.php';

try {
    $servicesParser = new CsvParser("./services.csv");
} catch (Exception $e) {
    echo $e->getMessage();
    return;
}

$validOptionInput = userOptionRequest();

if ($validOptionInput === "q") {
    $countryCode = getUserCountryCode();
    $matchingRows = $servicesParser->queryWhereColumnEqualsValue("Country", $countryCode);
    issueQueryResponse($countryCode, $matchingRows);
} else if ($validOptionInput === "s") {
    $existingCountryCodeCounts = $servicesParser->getEntryCountByColumn("Country", true);
    issueSummaryResponse($existingCountryCodeCounts, "Country");
}
