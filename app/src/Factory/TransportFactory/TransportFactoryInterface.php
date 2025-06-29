<?php

namespace App\Factory\TransportFactory;

use App\DTO\TransportDto;
use App\Entity\Transport\TransportInterface;

interface TransportFactoryInterface
{
    public function supports(TransportDto $dto): bool;

    public function create(TransportDto $dto): TransportInterface;
}