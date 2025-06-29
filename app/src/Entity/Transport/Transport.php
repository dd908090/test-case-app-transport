<?php

namespace App\Entity\Transport;

abstract class Transport implements TransportInterface
{
    public function __construct(
        protected string $type,
        protected string $brand,
        protected string $photoFileName,
    ) {
        $this->type = $type;
        $this->brand = $brand;
        $this->photoFileName = $photoFileName;
    }

    /**
     * @return string
     */
    public function getType(): string
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