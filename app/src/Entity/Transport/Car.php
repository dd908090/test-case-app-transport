<?php

namespace App\Entity\Transport;

use App\Enum\TransportType;

class Car extends Transport
{
    private int $passengerSeatsCount;
    private float $carrying;

    public function __construct(
        TransportType $type,
        string $brand,
        string $photoFileName,
        int $passengerSeatsCount,
        float $carrying
    ) {
        parent::__construct($type, $brand, $photoFileName);
        $this->passengerSeatsCount = $passengerSeatsCount;
        $this->carrying = $carrying;
    }

    public function getPassengerSeatsCount(): int
    {
        return $this->passengerSeatsCount;
    }

    public function getCarrying(): float
    {
        return $this->carrying;
    }

}