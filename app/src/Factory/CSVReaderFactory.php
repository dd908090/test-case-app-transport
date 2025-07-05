<?php

namespace App\Factory;


use App\Service\CSVHeaderIterator;

class CSVReaderFactory
{
    public function createReader(string $csvPath): \Iterator
    {
        return new CSVHeaderIterator($csvPath);
    }
}
