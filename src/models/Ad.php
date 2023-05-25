<?php

class Ad
{
    private $adID;
    private $dateFrom;
    private $dateTo;
    private $photoUrl;

    public function __construct(
        int $adID,
        string $dateFrom,
        string $dateTo,
        string $photoUrl
    ) {
        $this->adID = $adID;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->photoUrl = $photoUrl;
    }

    public function getAdID(): int
    {
        return $this->adID;
    }

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }
}