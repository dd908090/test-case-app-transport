<?php

namespace App\Service;

use App\DTO\TransportDto;
use League\Csv\Reader;

class TransportCsvParser
{
    public function __construct(
        private readonly string $fileStorage,
        private TransportBuilder $builder
    ) {
    }

    public function parse(string $csvFileName): array
    {
        $csvPath = sprintf('%s/%s', $this->fileStorage, $csvFileName);
        $results = [];
        $csv = Reader::createFromPath($csvPath);
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $row) {
            $dto = new TransportDto(
                $row['Тип'] ?? null,
                $row['Марка'] ?? null,
                $row['Фото'] ?? null,
                $row['Количество пассажирских мест'] ?? null,
                $row['Размеры кузова ДхШхВ'] ?? null,
                $row['Грузоподъемность'] ?? null,
                $row['Дополнительно'] ?? null,
            );

            $vehicle = $this->builder->build($dto);

            if ($vehicle) {
                $results[] = $vehicle;
            }
        }

        return $results;
    }

}