<?php

namespace App\Factory\TransportFactory;

use App\DTO\TransportDto;
use App\Entity\Transport\Car;
use App\Entity\Transport\TransportInterface;

class CarFactory implements TransportFactoryInterface
{

    public function supports(TransportDto $dto): bool
    {
        return $dto->type === 'car';
    }

    public function create(TransportDto $dto): TransportInterface
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