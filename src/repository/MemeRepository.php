<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Meme.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../repository/CommentRepository.php';
require_once __DIR__ . '/../controllers/SessionController.php';

class MemeRepository extends Repository
{
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->sessionController = new SessionController();
    }

    public function addMeme(string $title, string $photoUrl, int $evaluated = 0, string $evaluationDate = '0001-01-01'): void
    {
        $memeID = $this->getNextId('meme_main', 'memeid');
        $userID = $this->sessionController->unserializeUser()->getUserID();
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
        if ($this->sessionController->unserializeUser()) {
            $executionerid = $this->sessionController->unserializeUser()->getUserID() ?: 0;
        }

        $useridQuery = $userid ? 'WHERE userid = :userid ' : '';

        // 0: evaluated = true/false, 1: evaluated = true, 2: evaluated = false
        if ($onlyEvaluated === 1) {
            $evaluatedQuery = $userid ? 'AND evaluated = true' : 'WHERE evaluated = true';
        } else if ($onlyEvaluated === 2) {
            $evaluatedQuery = $userid ? 'AND evaluated = false' : 'WHERE evaluated = false';
        } else {
            $evaluatedQuery = '';
        }

        $offset = ($pageNumber - 1) * $numberOfMemes;

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM meme_main ' . $useridQuery . $evaluatedQuery . ' ORDER BY memeid DESC OFFSET :offset ROWS FETCH NEXT :numberofmemes ROWS ONLY
        ');

        if ($userid) {
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
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

    public function getMemeByID(int $memeid): ?Meme
    {
        $commentRepository = new CommentRepository();
        if ($this->sessionController->unserializeUser()) {
            $executionerid = $this->sessionController->unserializeUser()->getUserID() ?: 0;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_main WHERE memeid = :memeid
        ');
        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();

        $meme = array_values($stmt->fetch(PDO::FETCH_ASSOC));

        $comments = $commentRepository->getCommentsForMeme($memeid);
        $likes = $this->getLikesForMeme($memeid);
        if ($executionerid) {
            $followed = $this->getFollowForMeme($memeid, $executionerid);
        } else {
            $followed = 0;
        }

        $memeArray = [...array_values($meme), $comments, $likes, $followed];

        return new Meme(...$memeArray);
    }

    public function memesCount(int $onlyEvaluated = 0, int $userid = 0): int
    {
        $useridQuery = $userid ? 'WHERE userid = :userid ' : '';

        // 0: evaluated = true/false, 1: evaluated = true, 2: evaluated = false
        if ($onlyEvaluated === 1) {
            $evaluatedQuery = $userid ? 'AND evaluated = true' : 'WHERE evaluated = true';
        } else if ($onlyEvaluated === 2) {
            $evaluatedQuery = $userid ? 'AND evaluated = false' : 'WHERE evaluated = false';
        } else {
            $evaluatedQuery = '';
        }

        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) FROM meme_main ' . $useridQuery . $evaluatedQuery
        );

        if ($userid) {
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        }
        $stmt->execute();

        $counted = $stmt->fetch(PDO::FETCH_ASSOC);

        return $counted['count'];
    }

    public function getRandomMemeID(): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT memeid FROM meme_main
            ORDER BY RANDOM()
            LIMIT 1
        ');
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['memeid'];
    }

    public function getBestMemes(int $numberOfMemes, int $time = 30)
    {
        $time = $time == 7 ? 7 : 30;

        $stmt = $this->database->connect()->prepare("
        SELECT t1.memeid, t1.title, t1.photourl, SUM(t2.value) likes
        FROM meme_main t1, meme_like t2 
        WHERE t1.memeid = t2.memeid AND (DATE_PART('day', CURRENT_DATE::timestamp - t1.creationdate::timestamp) < :time)
        GROUP BY t1.memeid 
        ORDER BY likes DESC LIMIT :numberofmemes
        ");
        $stmt->bindParam(':time', $time, PDO::PARAM_INT);
        $stmt->bindParam(':numberofmemes', $numberOfMemes, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMeme(int $memeid): void
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM meme_main WHERE memeid = :memeid;
            DELETE FROM meme_like WHERE memeid = :memeid;
            DELETE FROM meme_comment WHERE memeid = :memeid;
            DELETE FROM user_follow WHERE memeid = :memeid;
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
            SELECT followid FROM user_follow WHERE memeid = :memeid AND userid = :userid
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['followid'] ? 1 : 0;
    }

    public function addLike($memeid): int
    {
        $isMemeEvaluated = $this->isMemeEvaluated($memeid);

        if ($this->sessionController->unserializeUser()) {
            $executionerid = $this->sessionController->unserializeUser()->getUserID() ?: 0;
        } else {
            return 0;
        }

        $value = $this->getLikeInfo($executionerid, $memeid);
        $memeLikes = $this->getLikesForMeme($memeid);

        if ($value === 0) {
            $creationDate = new DateTime();
            $stmt = $this->database->connect()->prepare('
                INSERT INTO meme_like (likeid, memeid, userid, value, creationdate) VALUES (?, ?, ?, ?, ?)
            ');
            $stmt->execute([
                $this->getNextId('meme_like', 'likeid'),
                $memeid,
                $executionerid,
                1,
                $creationDate->format('Y-m-d')
            ]);

            if (!$isMemeEvaluated && $memeLikes === 9) {
                $this->evaluateMeme($memeid);
            }

            return 1;
        } else if ($value === -1) {
            $creationDate = new DateTime();
            $stmt = $this->database->connect()->prepare('
                UPDATE meme_like SET value = 1 WHERE memeid = :memeid AND userid = :userid
                ');
            $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $executionerid, PDO::PARAM_INT);
            $stmt->execute();

            if (!$isMemeEvaluated && $memeLikes === 8) {
                $this->evaluateMeme($memeid);
            }

            return 2;
        } else {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM meme_like WHERE memeid = :memeid AND userid = :userid
            ');
            $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $executionerid, PDO::PARAM_INT);
            $stmt->execute();

            return -1;
        }
    }

    public function addDislike($memeid): int
    {
        if ($this->sessionController->unserializeUser()) {
            $executionerid = $this->sessionController->unserializeUser()->getUserID() ?: 0;
        } else {
            return 0;
        }

        $value = $this->getLikeInfo($executionerid, $memeid);

        if ($value === 0) {
            $creationDate = new DateTime();
            $stmt = $this->database->connect()->prepare('
                INSERT INTO meme_like (likeid, memeid, userid, value, creationdate) VALUES (?, ?, ?, ?, ?)
            ');
            $stmt->execute([
                $this->getNextId('meme_like', 'likeid'),
                $memeid,
                $executionerid,
                -1,
                $creationDate->format('Y-m-d')
            ]);

            return -1;
        } else if ($value === 1) {
            $creationDate = new DateTime();
            $stmt = $this->database->connect()->prepare('
                UPDATE meme_like SET value = -1 WHERE memeid = :memeid AND userid = :userid
            ');
            $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $executionerid, PDO::PARAM_INT);
            $stmt->execute();

            return -2;
        } else {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM meme_like WHERE memeid = :memeid AND userid = :userid
            ');
            $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $executionerid, PDO::PARAM_INT);
            $stmt->execute();

            return 1;
        }
    }

    public function getLikeInfo($userid, $memeid): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT value FROM meme_like WHERE memeid=:memeid AND userid=:userid;
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['value'] ?: 0;
    }

    public function addFavorites($memeid): string
    {
        if ($this->sessionController->unserializeUser()) {
            $executionerid = $this->sessionController->unserializeUser()->getUserID() ?: 0;
        } else {
            return 'black';
        }

        $isFollowed = $this->getInfoFavorites($memeid, $executionerid);

        if ($isFollowed) {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM user_follow WHERE memeid = :memeid AND userid = :userid
            ');
            $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $executionerid, PDO::PARAM_INT);
            $stmt->execute();

            return 'black';
        } else {
            $creationDate = new DateTime();
            $stmt = $this->database->connect()->prepare('
                INSERT INTO user_follow (followid, memeid, userid, creationdate) VALUES (?, ?, ?, ?)
            ');
            $stmt->execute([
                $this->getNextId('user_follow', 'followid'),
                $memeid,
                $executionerid,
                $creationDate->format('Y-m-d')
            ]);

            return 'red';
        }
    }

    public function getInfoFavorites($memeid, $userid): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT followid FROM user_follow WHERE memeid=:memeid AND userid=:userid;
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['followid'] ? 1 : 0;
    }

    public function evaluateMeme($memeid): void
    {
        $creationDate = new DateTime();
        $creationDate = $creationDate->format('Y-m-d');

        $stmt = $this->database->connect()->prepare('
            UPDATE meme_main SET evaluated = true, evaluationdate = :creationdate WHERE memeid = :memeid
        ');
        $stmt->bindParam(':creationdate', $creationDate, PDO::PARAM_INT);
        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function isMemeEvaluated($memeid)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT evaluated FROM meme_main WHERE memeid = :memeid
        ');
        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['evaluated'] ?: false;
    }
}