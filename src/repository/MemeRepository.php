<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Meme.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../repository/CommentRepository.php';
require_once __DIR__ . '/../controllers/SessionController.php';

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

    public function getMemes(int $pageNumber, int $numberOfMemes, int $onlyEvaluated, int $userid = 0): array
    {
        $commentRepository = new CommentRepository();
        $sessionController = new SessionController();
        if ($sessionController->unserializeUser()) {
            $executionerid = $sessionController->unserializeUser()->getUserID() ?: 0;
        }

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
            $comments = $commentRepository->getCommentsForMeme($meme['memeid']);
            $likes = $this->getLikesForMeme($meme['memeid']);
            if ($executionerid) {
                $followed = $this->getFollowForMeme($meme['memeid'], $executionerid);
            } else {
                $followed = 0;
            }

            $memeArray = [...array_values($meme), $comments, $likes, $followed];

            $result[] = new Meme(...$memeArray);
        }

        return $result;
    }

    public function memesCount(int $onlyEvaluated = 0, int $userid = 0): int
    {
        if ($userid) {
            $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) FROM meme_main WHERE userid = :userid
            ');
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        } else {
            $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) FROM meme_main
            ');
        }

        $stmt->execute();

        $counted = $stmt->fetch(PDO::FETCH_ASSOC);

        return $counted['count'];
    }

    public function getMeme(int $memeid): ?Meme
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_main WHERE memeid = :memeid
        ');
        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();

        $meme = array_values($stmt->fetch(PDO::FETCH_ASSOC));

        return new Meme(...$meme);
    }

    public function deleteMeme(int $memeid): void
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM meme_main WHERE memeid = :memeid
        ');
        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getLikesForMeme(int $memeid): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT SUM(value) FROM meme_like WHERE memeid = :memeid
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['sum'] ?: 0;
    }

    public function getFollowForMeme(int $memeid, int $userid): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_follow WHERE memeid = :memeid AND userid = :userid
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() ?: 0;
    }
}