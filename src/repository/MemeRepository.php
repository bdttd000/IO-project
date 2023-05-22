<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Meme.php';

class MemeRepository extends Repository
{
    public function addMeme(string $title, string $photoUrl, int $evaluated = 0, string $evaluationDate = '0001-01-01'): void
    {
        $memeID = $this->getNextId('meme_main', 'memeid');
        $sessionController = new SessionController();
        $userID = $sessionController->unserializeUser()->getUserID();
        $creationDate = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO meme_main (memeid, userid, title, photourl, creationdate, evaluated, evaluationdate) VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $memeID,
            $userID,
            $title,
            $photoUrl,
            $creationDate->format('Y-m-d'),
            $evaluated,
            $evaluationDate
        ]);
    }

    public function getMemes(int $pageNumber, int $numberOfMemes, bool $onlyEvaluated, int $userid = 0)
    {
        $offset = ($pageNumber - 1) * $numberOfMemes;

        if ($userid) {
            $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_main WHERE userid = :userid ORDER BY memeid OFFSET :offset ROWS FETCH NEXT :numberofmemes ROWS ONLY
            ');
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        } else {
            $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_main ORDER BY memeid OFFSET :offset ROWS FETCH NEXT :numberofmemes ROWS ONLY
            ');
        }

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':numberofmemes', $numberOfMemes, PDO::PARAM_INT);
        $stmt->execute();

        $memes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach ($memes as $meme) {
            array_push($result, new Meme(...array_values($meme)));
        }

        return $result;
    }

    public function getMeme(int $id): ?Meme
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_main WHERE memeid = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $meme = array_values($stmt->fetch(PDO::FETCH_ASSOC));

        return new Meme(...$meme);
    }

    public function printMeme(Meme $meme): void
    {
        echo $meme->getMemeID() . ' '
            . $meme->getUserID() . ' '
            . $meme->getTitle() . ' '
            . $meme->getPhotoUrl() . ' '
            . $meme->getCreationDate() . ' '
            . $meme->getEvaluated() . ' '
            . $meme->getEvaluationDate();
    }
}