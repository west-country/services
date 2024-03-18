<?php

function getUserOption(): string {
    echo "OPTIONS: \nQ. Query data by country code.\nS. Summarise data by country code.\n";
    return strtolower(readline("Please enter option [q/s]: "));
}

function userOptionRequest(): string {
    $userOption = getUserOption();
    while ($userOption !== "q" && $userOption !== "s") {
        echo "\nInvalid option: \"$userOption\"\n";
        $userOption = getUserOption();
    }
    return $userOption;
}

function getUserCountryCode(): string {
    return strtolower(readline("Enter country code: "));
}
