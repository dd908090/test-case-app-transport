<?php

namespace App\Contract;

use App\DTO\TransportDto;
use App\Entity\Transport\Transport;

interface TransportFactoryInterface
{
    public function supports(TransportDto $dto): bool;

    public function create(TransportDto $dto): Transport;
}