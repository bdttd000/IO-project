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
}