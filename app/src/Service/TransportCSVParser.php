<?php

namespace App\Service;

use App\DTO\TransportDto;
use App\Enum\TransportType;
use App\Factory\CSVReaderFactory;

class TransportCSVParser
{
    public function __construct(
        private readonly string $fileStorage,
        private TransportBuilder $builder,
        private CSVReaderFactory $csvReaderFactory,
    ) {
    }

    public function parse(string $csvFileName): array
    {
        $results = [];

        $csvPath = sprintf('%s/%s', $this->fileStorage, $csvFileName);
        $reader = $this->csvReaderFactory->createReader($csvPath);

        foreach ($reader as $row) {
            $type = TransportType::fromString($row['Тип'] ?? '');

            $dto = new TransportDto(
                $type,
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
