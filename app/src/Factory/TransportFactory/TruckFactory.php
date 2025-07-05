<?php

namespace App\Factory\TransportFactory;

use App\Contract\TransportFactoryInterface;
use App\DTO\TransportDto;
use App\Entity\Transport\Transport;
use App\Entity\Transport\Truck;
use App\Enum\TransportType;

class TruckFactory implements TransportFactoryInterface
{

    public function supports(TransportDto $dto): bool
    {
        return $dto->type === TransportType::TRUCK;
    }

    public function create(TransportDto $dto): Transport
    {
        [$length, $width, $height] = $this->parseDimensions($dto->dimensions);

        return new Truck(
            $dto->type,
            $dto->brand,
            $dto->photo,
            $length,
            $width,
            $height,
            $dto->carrying
        );
    }

    private function parseDimensions(?string $dims): array
    {
        if (!$dims || !preg_match('/^\d+(\.\d+)?x\d+(\.\d+)?x\d+(\.\d+)?$/', $dims)) {
            return [0.0, 0.0, 0.0];
        }

        return array_map('floatval', explode('x', $dims));
    }
}