<?php

namespace App\DTO;

use App\Enum\TransportType;

readonly class TransportDto
{
    public function __construct(
        public ?TransportType $type,
        public string $brand,
        public string $photo,
        public ?string $seats,
        public ?string $dimensions,
        public ?string $carrying,
        public ?string $extra
    ) {
    }
}