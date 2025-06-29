<?php

namespace App\DTO;

readonly class TransportDto
{
    public function __construct(
        public string $type,
        public string $brand,
        public string $photo,
        public ?string $seats,
        public ?string $dimensions,
        public ?string $carrying,
        public ?string $extra
    ) {
    }
}