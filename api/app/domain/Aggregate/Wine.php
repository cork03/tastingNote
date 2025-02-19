<?php

namespace App\domain\Aggregate;

class Wine
{
    public function __construct(
        private readonly ?int   $id,
        private readonly string $name,
        private readonly int    $producerId,
        private readonly int    $wineTypeId,
        private readonly int    $countryId,
        private readonly ?int    $appellationId,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProducerId(): int
    {
        return $this->producerId;
    }

    public function getWineTypeId(): int
    {
        return $this->wineTypeId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getAppellationId(): ?int
    {
        return $this->appellationId;
    }

    /**
     * @throws \Exception
     */
    public function validateAppellation(Appellation $appellation): void
    {
        if ($appellation->getAppellationType()->getCountryId() !== $this->countryId) {
            throw new \Exception('Invalid appellation');
        }
    }
}
