<?php

namespace App\Service;

use App\DTO\TransportDTO;
use App\Entity\Transport\Transport;

class TransportBuilder
{
    /**
     * @param iterable $factories
     */
    public function __construct(
        iterable $factories
    ) {
        $this->factories = $factories;
    }

    public function build(TransportDTO $dto): ?Transport
    {
        foreach ($this->factories as $factory) {
            if ($factory->supports($dto)) {
                return $factory->create($dto);
            }
        }

        return null;
    }
}
