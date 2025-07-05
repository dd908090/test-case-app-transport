<?php

namespace App\Enum;

enum TransportType: string
{
    case CAR = 'car';
    case TRUCK = 'truck';
    case SPEC_MACHINE = 'spec_machine';

    public static function fromString(?string $value): ?self
    {
        return match ($value) {
            'car' => self::CAR,
            'truck' => self::TRUCK,
            'spec_machine' => self::SPEC_MACHINE,
            default => null,
        };
    }
}