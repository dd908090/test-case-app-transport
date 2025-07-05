<?php

namespace App\Service;

use SplFileObject;
use Iterator;

class CSVHeaderIterator implements Iterator
{
    private SplFileObject $file;
    private ?array $header = null;
    private mixed $current = null;
    private int $key = 0;

    public function __construct(string $csvPath)
    {
        if (!file_exists($csvPath)) {
            throw new \InvalidArgumentException("Файл не найден: $csvPath");
        }

        $this->file = new SplFileObject($csvPath, 'r');
        $this->file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );
    }

    public function rewind(): void
    {
        $this->file->rewind();
        $this->header = null;
        $this->next(); // сразу перейти к первой строке данных
        $this->key = 0;
    }

    public function current(): mixed
    {
        return $this->current;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function next(): void
    {
        while (!$this->file->eof()) {
            $row = $this->file->fgetcsv();
            if ($row === [null] || $row === false) {
                continue;
            }

            if ($this->header === null) {
                $this->header = $row;
                continue;
            }

            $this->current = array_combine($this->header, $row);
            $this->key++;
            return;
        }

        $this->current = null;
    }

    public function valid(): bool
    {
        return $this->current !== null;
    }
}
