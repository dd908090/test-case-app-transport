<?php

namespace App\Entity\Transport;

use App\Enum\TransportType;

class SpecMachine extends Transport
{
    private string $extra;

    public function __construct(
        TransportType $type,
        string $brand,
        string $photoFileName,
        string $extra,
    ) {
        parent::__construct($type, $brand, $photoFileName);
        $this->extra = $extra;
    }

    public function getExtra(): string
    {
        return $this->extra;
    }
}