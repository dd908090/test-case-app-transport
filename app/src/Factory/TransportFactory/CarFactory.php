<?php

namespace App\Factory\TransportFactory;

use App\Contract\TransportFactoryInterface;
use App\DTO\TransportDto;
use App\Entity\Transport\Car;
use App\Entity\Transport\Transport;
use App\Enum\TransportType;

class CarFactory implements TransportFactoryInterface
{

    public function supports(TransportDto $dto): bool
    {
        return $dto->type === TransportType::CAR;
    }

    public function create(TransportDto $dto): Transport
    {
        return new Car(
            $dto->type,
            $dto->brand,
            $dto->seats,
            (int)$dto->photo,
            (float)$dto->carrying
        );
    }
}