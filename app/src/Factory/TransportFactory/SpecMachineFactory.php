<?php

namespace App\Factory\TransportFactory;

use App\DTO\TransportDto;
use App\Entity\Transport\SpecMachine;
use App\Entity\Transport\TransportInterface;

class SpecMachineFactory implements TransportFactoryInterface
{

    public function supports(TransportDto $dto): bool
    {
        return $dto->type === 'spec_machine';
    }

    public function create(TransportDto $dto): TransportInterface
    {
        return new SpecMachine(
            $dto->type,
            $dto->brand,
            $dto->photo,
            $dto->extra,
        );
    }
}