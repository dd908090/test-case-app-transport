<?php

namespace App\Entity\Transport;

interface TransportInterface
{
    public function getType(): string;

    public function getBrand(): string;

    public function getPhotoFileName(): string;

}