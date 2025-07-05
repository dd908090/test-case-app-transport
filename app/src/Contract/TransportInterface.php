<?php

namespace App\Contract;

use App\Enum\TransportType;

interface TransportInterface
{
    public function getType(): TransportType;

    public function getBrand(): string;

    public function getPhotoFileName(): string;

}