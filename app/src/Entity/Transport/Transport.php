<?php

namespace App\Entity\Transport;

use App\Contract\TransportInterface;
use App\Enum\TransportType;

abstract class Transport implements TransportInterface
{
    public function __construct(
        protected TransportType $type,
        protected string $brand,
        protected string $photoFileName,
    ) {
        $this->type = $type;
        $this->brand = $brand;
        $this->photoFileName = $photoFileName;
    }

    /**
     * @return TransportType
     */
    public function getType(): TransportType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getPhotoFileName(): string
    {
        return pathinfo($this->photoFileName, PATHINFO_EXTENSION);
    }
}