<?php

class CsvReader
{
    protected string $fileLocation;

    public function __construct(string $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    final public function readFile(callable $callbackForReadingFile): array | Exception
    {
        if (file_exists($this->fileLocation)) {
            if (($openFile = fopen($this->fileLocation, "r")) !== false) {
                    $parsedData = $callbackForReadingFile($openFile);
                    fclose($openFile);
                    return $parsedData;
            }
        } else {
            throw new RuntimeException("Invalid file path\n");
        }
    }
}
