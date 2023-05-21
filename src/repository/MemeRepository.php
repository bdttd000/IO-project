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
}