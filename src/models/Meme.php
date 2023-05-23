<?php

class Meme
{
    private $memeid;
    private $userid;
    private $title;
    private $photourl;
    private $creationDate;
    private $evaluated;
    private $evaluationdate;
    private $comments;
    private $likes;
    private $followed;

    public function __construct(
        int $memeid,
        int $userid,
        string $title,
        string $photourl,
        string $creationDate,
        string $evaluated,
        string $evaluationdate,
        array $comments,
        int $likes,
        int $followed
    ) {
        $this->memeid = $memeid;
        $this->userid = $userid;
        $this->title = $title;
        $this->photourl = $photourl;
        $this->creationDate = $creationDate;
        $this->evaluated = $evaluated;
        $this->evaluationdate = $evaluationdate;
        $this->comments = $comments;
        $this->likes = $likes;
        $this->followed = $followed;
    }

    public function getMemeID(): int
    {
        return $this->memeid;
    }

    public function getUserID(): int
    {
        return $this->userid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPhotoUrl(): string
    {
        return $this->photourl;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getEvaluated(): string
    {
        return $this->evaluated;
    }

    public function getEvaluationDate(): string
    {
        return $this->evaluationdate;
    }

    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function getFollowed(): int
    {
        return $this->followed;
    }
}