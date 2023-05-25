<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Ad.php';
require_once __DIR__ . '/../controllers/SessionController.php';

class AdRepository extends Repository
{
    public function addAd($dateFrom, $dateTo, string $photoUrl): void
    {
        $adID = $this->getNextId('ad_main', 'adid');

        $stmt = $this->database->connect()->prepare('
            INSERT INTO ad_main (adid, activefrom, expirationdate, photourl) VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $adID,
            $dateFrom,
            $dateTo,
            $photoUrl
        ]);
    }

    public function getAds(int $numberOfAds): array
    {

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM ad_main ORDER BY adid DESC LIMIT :numberofads
        ');

        $stmt->bindParam(':numberofads', $numberOfAds, PDO::PARAM_INT);
        $stmt->execute();

        $ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($ads as $ad) {
            $result[] = new Ad(...array_values($ad));
        }

        return $result;
    }
}