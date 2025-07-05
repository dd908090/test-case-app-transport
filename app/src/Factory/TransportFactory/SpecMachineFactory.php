<?php

namespace App\Factory\TransportFactory;

use App\Contract\TransportFactoryInterface;
use App\DTO\TransportDto;
use App\Entity\Transport\SpecMachine;
use App\Entity\Transport\Transport;
use App\Enum\TransportType;

class SpecMachineFactory implements TransportFactoryInterface
{

    public function supports(TransportDto $dto): bool
    {
        return $dto->type === TransportType::SPEC_MACHINE;
    }

    public function create(TransportDto $dto): Transport
    {
        return new SpecMachine(
            $dto->type,
            $dto->brand,
            $dto->photo,
            $dto->extra,
        );
    }
}