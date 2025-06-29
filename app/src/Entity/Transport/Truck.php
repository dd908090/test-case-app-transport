<?php

namespace App\Entity\Transport;

class Truck extends Transport
{

    private float $bodyLength;
    private float $bodyWidth;
    private float $bodyHeight;
    private float $carrying;

    public function __construct(
        string $type,
        string $brand,
        string $photoFileName,
        float $length,
        float $width,
        float $height,
        float $carrying
    ) {
        parent::__construct($type, $brand, $photoFileName);

        $this->bodyLength = $length;
        $this->bodyWidth = $width;
        $this->bodyHeight = $height;
        $this->carrying = $carrying;
    }

    public function getBodyVolume(): float
    {
        return $this->bodyLength * $this->bodyWidth * $this->bodyHeight;
    }
}
