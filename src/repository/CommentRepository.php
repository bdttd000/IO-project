<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Comment.php';

class CommentRepository extends Repository
{
    public function getCommentsForMeme(int $memeid): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM meme_comment WHERE memeid = :memeid
        ');

        $stmt->bindParam(':memeid', $memeid, PDO::PARAM_INT);
        $stmt->execute();

        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($comments as $comment) {
            $result[] = new Comment(...array_values($comment));
        }

        return $result;
    }

    public function addComment(int $memeid, int $userid, string $content): array
    {
        $creationDate = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO meme_comment (commentid, memeid, userid, content, creationdate) VALUES (?, ?, ?, ?, ?)
        ');
        $commentid = $this->getNextId('meme_comment', 'commentid');

        if (
            $stmt->execute([
                $commentid,
                $memeid,
                $userid,
                $content,
                $creationDate->format('Y-m-d')
            ])
        ) {
            return [
                'commentid' => $commentid,
                'memeid' => $memeid,
                'userid' => $userid,
                'content' => $content,
                'creationdate' => $creationDate->format('Y-m-d')
            ];
        } else {
            return [];
        }
    }
}